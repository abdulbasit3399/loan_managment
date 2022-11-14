<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\LoanProduct;
use App\Models\TransactionFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanProductController extends Controller {

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
    public function index() {
        $loanproducts = LoanProduct::all()->sortByDesc("id");
        return view('backend.loan_product.list', compact('loanproducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $transactionFees = TransactionFee::all()->sortByDesc("id");
        if (!$request->ajax()) {
            return view('backend.loan_product.create',compact('transactionFees'));
        } else {
            return view('backend.loan_product.modal.create',compact('transactionFees'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'minimum_amount' => 'required|numeric',
            'maximum_amount' => 'required|numeric',
            'interest_rate'  => 'required|numeric',
            'interest_type'  => 'required',
            'term'           => 'required|integer',
            'term_period'    => 'required',
            'status'         => 'required',
            'penalties'      => 'required',
            'down_payment'   => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loan_products.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $loanproduct                 = new LoanProduct();
        $loanproduct->name           = $request->input('name');
        $loanproduct->minimum_amount = $request->minimum_amount;
        $loanproduct->maximum_amount = $request->maximum_amount;
        $loanproduct->description    = $request->input('description');
        $loanproduct->interest_rate  = $request->input('interest_rate');
        $loanproduct->interest_type  = $request->input('interest_type');
        $loanproduct->term           = $request->input('term');
        $loanproduct->term_period    = $request->input('term_period');
        $loanproduct->status         = $request->input('status');
        $loanproduct->visibility         = $request->input('visibility');
        $loanproduct->penalties      = $request->input('penalties');
        $loanproduct->down_payment   = $request->input('down_payment');

        $loanproduct->save();

        if($request->transaction_fee){
            foreach($request->transaction_fee as $fee){
                $loanproduct->transactionFee()->attach([$fee]);
            }
        }

        //Prefix Output
        $loanproduct->interest_type = ucwords(str_replace("_", " ", $loanproduct->interest_type));
        $loanproduct->term_period   = ucwords($loanproduct->term_period);

        if (!$request->ajax()) {
            return redirect()->route('loan_products.index')->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $loanproduct, 'table' => '#loan_products_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $loanproduct = LoanProduct::find($id);
        if (!$request->ajax()) {
            return view('backend.loan_product.view', compact('loanproduct', 'id'));
        } else {
            return view('backend.loan_product.modal.view', compact('loanproduct', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $transactionFees = TransactionFee::all()->sortByDesc("id");
        $loanproduct = LoanProduct::find($id);
        $loanproduct_transactionFee = $loanproduct->transactionFee;
        if (!$request->ajax()) {
            return view('backend.loan_product.edit', compact('loanproduct', 'id', 'transactionFees', 'loanproduct_transactionFee'));
        } else {
            return view('backend.loan_product.modal.edit', compact('loanproduct', 'id', 'transactionFees', 'loanproduct_transactionFee'));
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
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'minimum_amount' => 'required|numeric',
            'maximum_amount' => 'required|numeric',
            'interest_rate'  => 'required|numeric',
            'interest_type'  => 'required',
            'term'           => 'required|integer',
            'term_period'    => 'required',
            'status'         => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loan_products.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $loanproduct                 = LoanProduct::find($id);
        $loanproduct->name           = $request->input('name');
        $loanproduct->minimum_amount = $request->minimum_amount;
        $loanproduct->maximum_amount = $request->maximum_amount;
        $loanproduct->description    = $request->input('description');
        $loanproduct->interest_rate  = $request->input('interest_rate');
        $loanproduct->interest_type  = $request->input('interest_type');
        $loanproduct->term           = $request->input('term');
        $loanproduct->term_period    = $request->input('term_period');
        $loanproduct->status         = $request->input('status');
        $loanproduct->visibility     = $request->input('visibility');

        $loanproduct->save();

        $loanproduct->transactionFee()->detach();

        foreach($request->transaction_fee as $fee){
            $loanproduct->transactionFee()->attach([$fee]);
        }

        //Prefix Output
        $loanproduct->interest_type = ucwords(str_replace("_", " ", $loanproduct->interest_type));
        $loanproduct->term_period   = ucwords($loanproduct->term_period);

        if (!$request->ajax()) {
            return redirect()->route('loan_products.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $loanproduct, 'table' => '#loan_products_table']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $loanproduct = LoanProduct::find($id);
        $loanproduct->delete();
        return redirect()->route('loan_products.index')->with('success', _lang('Deleted successfully'));
    }

    public function duplicate($id)
    {
        $loanproduct = LoanProduct::find($id);
        $newPost = $loanproduct->replicate();
        $newPost->created_at = Carbon::now();
        $newPost->save();

        return redirect()->route('loan_products.index')->with('success', _lang('Loan Product duplicate successfully'));
    }

    public function getPalenties($id){
        $loanproduct = LoanProduct::find($id);
        return response()->json(['result' => 'success', 'data' => $loanproduct]);

    }
    public function getUserDetail($id)
    {
        $user = User::find($id);
        $company = 0;
        if($user->company_id && $user->company_id != 0 && $user->verified == 0)
            $company = $user->company_id;
        return response()->json(['result' => 'success', 'data' => $company]);
    }
}