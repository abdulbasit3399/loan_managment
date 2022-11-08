<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loan;
use App\Models\LoanCollateral;
use App\Models\LoanPayment;
use App\Models\LoanRepayment;
use App\Models\LoanProduct;
use App\Models\TransactionFee;
use App\Models\Transaction;
use App\Notifications\RequireEndorsementLetter;
use App\Notifications\ApprovedLoanRequest;
use App\Notifications\RejectLoanRequest;
use App\Utilities\LoanCalculator as Calculator;
use Auth;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoanController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
      return view('backend.loan.list');
    }

    public function get_table_data(Request $request) {

      $loans = Loan::select('loans.*')
      ->with('borrower')
      ->with('currency')
      ->with('loan_product')
      ->orderBy("loans.id", "desc");

      return Datatables::eloquent($loans)
      ->filter(function ($query) use ($request) {
        if ($request->has('status')) {
          $query->where('status', $request->status);
        }
      }, true)
      ->editColumn('borrower.first_name', function ($loan) {
        return $loan->borrower->first_name . ' ' . $loan->borrower->last_name;
      })
      ->editColumn('applied_amount', function ($loan) {
        return decimalPlace($loan->applied_amount, currency($loan->currency->name));
      })
      ->editColumn('status', function ($loan) {

        if ($loan->status == 0) {
          return show_status(_lang('Pending'), 'warning');
        } else if ($loan->status == 1) {
          return show_status(_lang('Approved'), 'success');
        } elseif ($loan->status == 2) {
          return show_status(_lang('Completed'), 'info');
        } elseif ($loan->status == 3) {
          return show_status(_lang('Cancelled'), 'danger');
        }

      })
      ->addColumn('action', function ($loan) {
        return '<form action="' . action('LoanController@destroy', $loan['id']) . '" class="text-center" method="post">'
        . '<a href="' . action('LoanController@show', $loan['id']) . '" class="btn btn-primary btn-sm">' . _lang('View') . '</a>&nbsp;'
        . '<a href="' . action('LoanController@edit', $loan['id']) . '" class="btn btn-warning btn-sm">' . _lang('Edit') . '</a>&nbsp;'
        . csrf_field()
        . '<input name="_method" type="hidden" value="DELETE">'
        . '<button class="btn btn-danger btn-sm btn-remove" type="submit">' . _lang('Delete') . '</button>'
        . '</form>';
      })
      ->setRowId(function ($loan) {
        return "row_" . $loan->id;
      })
      ->rawColumns(['status', 'action'])
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
      $lastLoan = Loan::orderBy('id','DESC')->first();
      if (!$request->ajax()) {
        return view('backend.loan.create',compact('lastLoan'));
      } else {
        return view('backend.loan.modal.create',compact('lastLoan'));
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $validator = Validator::make($request->all(), [
        'loan_id'                => 'required|unique:loans',
        'loan_product_id'        => 'required',
        'loan_purpose_id'       => 'required',
        'borrower_id'            => 'required',
            // 'currency_id'            => 'required',
        'first_payment_date'     => 'required',
        'release_date'           => 'required',
        'applied_amount'         => 'required|numeric',
        'late_payment_penalties' => 'required|numeric',
        'attachment'             => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
      ]);

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return redirect()->route('loans.create')
          ->withErrors($validator)
          ->withInput();
        }
      }

      $attachment = "";
      if ($request->hasfile('attachment')) {
        $file       = $request->file('attachment');
        $attachment = time() . $file->getClientOriginalName();
        $file->move(public_path() . "/uploads/media/", $attachment);
      }

      DB::beginTransaction();

      $loan                         = new Loan();
      $loan->loan_id                = $request->input('loan_id');
      $loan->loan_product_id        = $request->input('loan_product_id');
      $loan->borrower_id            = $request->input('borrower_id');
      $loan->currency_id            = 1;
      $loan->endoresment_required   = $request->input('endoresment_required');
      $loan->first_payment_date     = $request->input('first_payment_date');
      $loan->release_date           = $request->input('release_date');
      $loan->loan_purpose_id        = $request->input('loan_purpose_id');
      $loan->applied_amount         = $request->input('applied_amount');
      $loan->late_payment_penalties = $request->input('late_payment_penalties');
      $loan->attachment             = $attachment;
      $loan->description            = $request->input('description');
      $loan->remarks                = $request->input('remarks');
      $loan->created_user_id        = Auth::id();
      $loan->branch_id              = auth()->user()->branch_id;
      $loan->save();


      if($request->input('endoresment_required') == 1)
      {
        $user = User::find($request->input('borrower_id'));
        $company = User::find($user->company_id);
        $company->notify(new RequireEndorsementLetter($loan));
      }
      $calculator = new Calculator(
        $loan->applied_amount,
        $loan->first_payment_date,
        $loan->loan_product->interest_rate,
        $loan->loan_product->term,
        $loan->loan_product->term_period,
        $loan->late_payment_penalties,
        $loan
      );

      if ($loan->loan_product->interest_type == 'flat_rate') {
        $repayments = $calculator->get_flat_rate();
      } else if ($loan->loan_product->interest_type == 'fixed_rate') {
        $repayments = $calculator->get_fixed_rate();
      }else if ($loan->loan_product->interest_type == 'diminishing_rate') {
        $repayments = $calculator->get_diminishing_rate();
      } else if ($loan->loan_product->interest_type == 'mortgage') {
        $repayments = $calculator->get_mortgage();
      } else if ($loan->loan_product->interest_type == 'one_time') {
        $repayments = $calculator->get_one_time();
      }

      $loan->total_payable = $calculator->payable_amount;
      $loan->save();

      DB::commit();

      if (!$request->ajax()) {
        return redirect()->route('loans.show', $loan->id)->with('success', _lang('New Loan added successfully'));
      } else {
        return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('New Loan added successfully'), 'data' => $loan, 'table' => '#loans_table']);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
      $transactionFees = TransactionFee::all();
      $loan            = Loan::find($id);
      $loancollaterals = LoanCollateral::where('loan_id', $loan->id)
      ->orderBy("id", "desc")
      ->get();

      $repayments = LoanRepayment::where('loan_id', $loan->id)->get();

      $payments = LoanPayment::where('loan_id', $loan->id)->get();

      if (!$request->ajax()) {
        return view('backend.loan.view', compact('loan', 'loancollaterals', 'repayments', 'payments', 'transactionFees'));
      } else {
        return view('backend.loan.modal.view', compact('loan', 'loancollaterals', 'repayments', 'payments', 'transactionFees'));
      }

    }

    /**
     * Approve Loan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id) {

      DB::beginTransaction();

      $loan = Loan::find($id);
      if ($loan->status == 1) {
        abort(403);
      }
      
      if ($loan->loan_id == NULL || $loan->release_date == NULL) {
        return back()->with('error', _lang('Loan ID and Release date must required !'));
      }

      $loan->status           = 1;
      $loan->approved_date    = date('Y-m-d');
      $loan->approved_user_id = Auth::id();
      $loan->save();

        // Create Loan Repayments
      $calculator = new Calculator(
        $loan->applied_amount,
        $loan->getRawOriginal('first_payment_date'),
        $loan->loan_product->interest_rate,
        $loan->loan_product->term,
        $loan->loan_product->term_period,
        $loan->late_payment_penalties,
        $loan
      );
      if ($loan->loan_product->interest_type == 'flat_rate') {
        $repayments = $calculator->get_flat_rate();
      } else if ($loan->loan_product->interest_type == 'fixed_rate') {
        $repayments = $calculator->get_fixed_rate();
      }else if ($loan->loan_product->interest_type == 'diminishing_rate') {
        $repayments = $calculator->get_diminishing_rate();
      } else if ($loan->loan_product->interest_type == 'mortgage') {
        $repayments = $calculator->get_mortgage();
      } else if ($loan->loan_product->interest_type == 'one_time') {
        $repayments = $calculator->get_one_time();
      }

      $loan->total_payable = $calculator->payable_amount;
      $loan->save();

      foreach ($repayments as $repayment) {
        $loan_repayment                   = new LoanRepayment();
        $loan_repayment->loan_id          = $loan->id;
        $loan_repayment->repayment_date   = $repayment['date'];
        $loan_repayment->amount_to_pay    = $repayment['amount_to_pay'];
        $loan_repayment->penalty          = $repayment['penalty'];
        $loan_repayment->principal_amount = $repayment['principle_amount'];
        $loan_repayment->interest         = $repayment['interest'];
        $loan_repayment->balance          = $repayment['balance'];
        $loan_repayment->save();
      }

        //Create Transaction
      $transaction                  = new Transaction();
      $transaction->user_id         = $loan->borrower_id;
      $transaction->currency_id     = $loan->currency_id;
      $transaction->amount          = $loan->applied_amount;
      $transaction->dr_cr           = 'cr';
      $transaction->type            = 'Loan';
      $transaction->method          = 'Manual';
      $transaction->status          = 2;
      $transaction->note            = 'Loan Approved';
      $transaction->loan_id         = $loan->id;
      $transaction->created_user_id = auth()->id();

      $transaction->save();

      DB::commit();

      try {
        $transaction->user->notify(new ApprovedLoanRequest($transaction));
      } catch (\Exception $e) {
        return $e;
      }

      return back()->with('success', _lang('Loan Request Approved'));

    }

    /**
     * Reject Loan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id) {
      $loan = Loan::find($id);
      /** If not pending */
      if ($loan->status != 0) {
        abort(403);
      }
        $loan->status = 3; //Cancelled
        $loan->save();

        try {
          $loan->borrower->notify(new RejectLoanRequest($loan));
        } catch (\Exception $e) {}

        return back()->with('success', _lang('Loan Request Rejected'));
      }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
      $loan = Loan::find($id);
      if ($loan->status == 2) {
        return back()->with('error', _lang('Sorry, This Loan is already completed'));
      }
      if (!$request->ajax()) {
        return view('backend.loan.edit', compact('loan', 'id'));
      } else {
        return view('backend.loan.modal.edit', compact('loan', 'id'));
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $loan = Loan::find($id);
      if ($loan->status == 2) {
        return back()->with('error', _lang('Sorry, This Loan is already completed'));
      }
      if ($loan->status != 0) {
        $loan->description = $request->input('description');
        $loan->remarks     = $request->input('remarks');

        $loan->save();

        return redirect()->route('loans.index')->with('success', _lang('Updated successfully'));
      } else {
        $validator = Validator::make($request->all(), [
          'loan_id'                => [
            'required',
            Rule::unique('loans')->ignore($id),
          ],
          'loan_product_id'        => 'required',
          'borrower_id'            => 'required',
                // 'currency_id'            => 'required',
          'first_payment_date'     => 'required',
          'release_date'           => 'required',
          'applied_amount'         => 'required|numeric',
          'late_payment_penalties' => 'required|numeric',
          'attachment'             => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
        ]);
      }

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return redirect()->route('loans.edit', $id)
          ->withErrors($validator)
          ->withInput();
        }
      }

      if ($request->hasfile('attachment')) {
        $file       = $request->file('attachment');
        $attachment = time() . $file->getClientOriginalName();
        $file->move(public_path() . "/uploads/media/", $attachment);
      }

      DB::beginTransaction();

      $loan                         = Loan::find($id);
      $loan->loan_id                = $request->input('loan_id');
      $loan->loan_product_id        = $request->input('loan_product_id');
      $loan->borrower_id            = $request->input('borrower_id');
        // $loan->currency_id            = $request->input('currency_id');
      $loan->first_payment_date     = $request->input('first_payment_date');
      $loan->release_date           = $request->input('release_date');
      $loan->applied_amount         = $request->input('applied_amount');
      $loan->late_payment_penalties = $request->input('late_payment_penalties');
      if ($request->hasfile('attachment')) {
        $loan->attachment = $attachment;
      }
      $loan->description = $request->input('description');
      $loan->remarks     = $request->input('remarks');

      $loan->save();

        // Create Loan Repayments
      $calculator = new Calculator(
        $loan->applied_amount,
        $loan->first_payment_date,
        $loan->loan_product->interest_rate,
        $loan->loan_product->term,
        $loan->loan_product->term_period,
        $loan->late_payment_penalties,
        $loan
      );

      if ($loan->loan_product->interest_type == 'flat_rate') {
        $repayments = $calculator->get_flat_rate();
      } else if ($loan->loan_product->interest_type == 'fixed_rate') {
        $repayments = $calculator->get_fixed_rate();
      }else if ($loan->loan_product->interest_type == 'diminishing_rate') {
        $repayments = $calculator->get_diminishing_rate();
      } else if ($loan->loan_product->interest_type == 'mortgage') {
        $repayments = $calculator->get_mortgage();
      } else if ($loan->loan_product->interest_type == 'one_time') {
        $repayments = $calculator->get_one_time();
      }
      $loan->total_payable = $calculator->payable_amount;
      $loan->save();

      DB::commit();

      if (!$request->ajax()) {
        return redirect()->route('loans.index')->with('success', _lang('Updated successfully'));
      } else {
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $loan, 'table' => '#loans_table']);
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      DB::beginTransaction();

      $loan = Loan::find($id);

      $loancollaterals = LoanCollateral::where('loan_id', $loan->id);
      $loancollaterals->delete();

      $repayments = LoanRepayment::where('loan_id', $loan->id);
      $repayments->delete();

      $loanpayment = LoanPayment::where('loan_id', $loan->id);
      $loanpayment->delete();

      $transaction = Transaction::where('loan_id', $loan->id);
      $transaction->delete();

      $loan->delete();

      DB::commit();

      return redirect()->route('loans.index')->with('success', _lang('Deleted successfully'));
    }

    public function calculator() {
      $data                           = array();
      $data['first_payment_date']     = '';
      $data['apply_amount']           = '';
      $data['interest_rate']          = '';
      $data['interest_type']          = '';
      $data['term']                   = '';
      $data['term_period']            = '';
      $data['late_payment_penalties'] = 0;
      return view('backend.loan.calculator', $data);
    }

    public function calculate(Request $request) {
      $validator = Validator::make($request->all(), [
        'apply_amount'           => 'required|numeric',
        'interest_rate'          => 'required',
        'interest_type'          => 'required',
        'term'                   => 'required|integer|max:100',
        'term_period'            => $request->interest_type == 'one_time' ? '' : 'required',
        'late_payment_penalties' => 'required',
        'first_payment_date'     => 'required',
      ]);

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return redirect()->route('loans.admin_calculator')->withErrors($validator)->withInput();
        }
      }

      $first_payment_date     = $request->first_payment_date;
      $apply_amount           = $request->apply_amount;
      $interest_rate          = $request->interest_rate;
      $interest_type          = $request->interest_type;
      $term                   = $request->term;
      $term_period            = $request->term_period;
      $late_payment_penalties = $request->late_payment_penalties;

      $data       = array();
      $table_data = array();

      if ($interest_type == 'flat_rate') {

        $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
        $table_data             = $calculator->get_flat_rate();
        $data['payable_amount'] = $calculator->payable_amount;

      } else if ($interest_type == 'fixed_rate') {

        $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
        $table_data             = $calculator->get_fixed_rate();
        $data['payable_amount'] = $calculator->payable_amount;

      } else if ($interest_type == 'diminishing_rate') {

        $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
        $table_data             = $calculator->get_diminishing_rate();
        $data['payable_amount'] = $calculator->payable_amount;

      } else if ($interest_type == 'mortgage') {

        $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
        $table_data             = $calculator->get_mortgage();
        $data['payable_amount'] = $calculator->payable_amount;

      } else if ($interest_type == 'one_time') {

        $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, 1, $term_period, $late_payment_penalties);
        $table_data             = $calculator->get_one_time();
        $data['payable_amount'] = $calculator->payable_amount;

      }

      $data['table_data']             = $table_data;
      $data['first_payment_date']     = $request->first_payment_date;
      $data['apply_amount']           = $request->apply_amount;
      $data['interest_rate']          = $request->interest_rate;
      $data['interest_type']          = $request->interest_type;
      $data['term']                   = $request->term;
      $data['term_period']            = $request->term_period;
      $data['late_payment_penalties'] = $request->late_payment_penalties;

      return view('backend.loan.calculator', $data);

    }
    public function loan_product_id(Request $request)
    {
      $loan = LoanProduct::find($request->id);
      return $loan->penalties;
    }
    public function loan_payment_status($id,$status)
    {
      if($status == 2)
      {
        $payment = LoanPayment::find($id);

        $loan_repayment = LoanRepayment::find($payment->loan_repayment_id);
        $loan_repayment->status = 0;
        $loan_repayment->save();

        unlink(public_path().'/uploads/recipet/'.$payment->reciept);
        $payment->delete();
      }
      else
      {
        $payment = LoanPayment::find($id);

        $loan_repayment = LoanRepayment::find($payment->loan_repayment_id);
        $loan_repayment->status = 1;
        $loan_repayment->save();

        $payment->status = $status;
        $payment->save();
      }

      return redirect()->back()->with('success', _lang('Status changed successfully.'));
    }
    public function change_loan_repayments($id,$status)
    {
      $loan_repayment = LoanRepayment::find($id);
      $loan_repayment->status = $status;
      $loan_repayment->save();
      
      return redirect()->back()->with('success', _lang('Status changed successfully.'));
    }
    public function manual_payment($id)
    {
      DB::beginTransaction();

      $loan    = Loan::where('id', $id)->first();
      $user = User::find($loan->borrower_id);
      $repayment = $loan->next_payment;
      $penalty = date('Y-m-d') > $repayment->repayment_date ? $repayment->penalty : 0;
      $amount  = $repayment->amount_to_pay + $penalty;
      $name = '';

      $debit                  = new Transaction();
      $debit->user_id         = $user->id;
      $debit->currency_id     = $loan->currency_id;
      $debit->amount          = $amount;
      $debit->dr_cr           = 'dr';
      $debit->type            = 'Loan_Repayment';
      $debit->method          = 'Online';
      $debit->status          = 2;
      $debit->note            = _lang('Loan Repayment');
      $debit->created_user_id = $user->id;
      $debit->branch_id       = $user->branch_id;
      $debit->loan_id         = $loan->id;

      $debit->save();

      $loanpayment                 = new LoanPayment();
      $loanpayment->loan_id        = $loan->id;
      $loanpayment->loan_repayment_id    = $repayment->id;
      $loanpayment->paid_at        = date('Y-m-d');
      $loanpayment->late_penalties = $penalty;
      $loanpayment->interest       = $repayment->interest;
      $loanpayment->amount_to_pay  = $repayment->amount_to_pay;
      $loanpayment->remarks        = '';
      $loanpayment->transaction_id = $debit->id;
      $loanpayment->repayment_id   = $repayment->id;
      $loanpayment->user_id        = $user->id;
      $loanpayment->reciept        = $name;

      $loanpayment->save();

      $repayment->status = 1;
      $repayment->save();
      $loan->total_paid = $loan->total_paid + $repayment->amount_to_pay;
      if ($loan->total_paid >= $loan->applied_amount) {
        $loan->status = 2;
      }
      $loan->save();

      DB::commit();
      return redirect()->back()->with('success', _lang('Loan payment paid successfully.'));
    }

  }