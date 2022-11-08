<?php

namespace App\Http\Controllers;

use DB;
use App\Models\FixedDeposit;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanRepayment;
use App\Models\Transaction;
use App\Models\Company;
use App\Models\CompanySoaReports;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade;

class ReportController extends Controller {


  public function __construct() {
    date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
  }


  public function transactions_report(Request $request) {
    if ($request->isMethod('get')) {
      $data['report_data'] = Transaction::select('transactions.*')
      ->with(['user', 'currency'])
      ->orderBy('id', 'desc')
      ->get();
      return view('backend.reports.transactions_report',$data);
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data             = array();
      $date1            = $request->date1;
      $date2            = $request->date2;
      $user_account     = isset($request->user_account) ? $request->user_account : '';
      $status           = isset($request->status) ? $request->status : '';
      $transaction_type = isset($request->transaction_type) ? $request->transaction_type : '';

      $data['report_data'] = Transaction::select('transactions.*')
      ->with(['user', 'currency'])
      ->when($status, function ($query, $status) {
        return $query->where('status', $status);
      }, function ($query, $status) {
        if ($status != '') {
          return $query->where('status', $status);
        }
      })
      ->when($transaction_type, function ($query, $transaction_type) {
        return $query->where('type', $transaction_type);
      })
      ->when($user_account, function ($query, $user_account) {
        return $query->whereHas('user', function ($query) use ($user_account) {
          return $query->where('email', $user_account)
          ->orWhere('account_number', $user_account);
        });
      })
      ->whereRaw("date(transactions.created_at) >= '$date1' AND date(transactions.created_at) <= '$date2'")
      ->orderBy('id', 'desc')
      ->get();
      $data['date1']            = $request->date1;
      $data['date2']            = $request->date2;
      $data['status']           = $request->status;
      $data['user_account']     = $request->user_account;
      $data['transaction_type'] = $request->transaction_type;
      return view('backend.reports.transactions_report', $data);
    }

  }
  public function additional(Request $request)
  {
    if ($request->isMethod('get')) {
      return view('backend.reports.additional');
    } else if ($request->isMethod('post')) {

      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $user_account = isset($request->user_account) ? $request->user_account : '';
      $status       = isset($request->status) ? $request->status : '';
      $loan_type    = isset($request->loan_type) ? $request->loan_type : '';
      $user_data['age_to'] = isset($request->age_to) ? $request->age_to : '2';
      $user_data['age_from'] = isset($request->age_from) ? $request->age_from : '1';
      $user_data['gender'] = isset($request->gender) ? $request->gender : '';
      $user_data['marital_status'] = isset($request->marital_status) ? $request->marital_status : '';

      $data['report_data'] = Loan::select('loans.*')
      ->with(['borrower', 'loan_product', 'currency'])

      ->when($user_data, function ($query, $user_data) {
        return $query->whereHas('borrower', function ($query) use ($user_data) {
          if($user_data['gender'] != '')
            return $query->where([['age','>=',$user_data['age_from']],['age','<=',$user_data['age_to']]]);
        });
      })
      ->when($request->gender, function ($query, $request) {
        return $query->whereHas('borrower', function ($query) use ($request) {
          return $query->where('gender',$request);
            
        });
      })
      ->when($request->marital_status, function ($query, $request) {
        return $query->whereHas('borrower', function ($query) use ($request) {
          return $query->where('marital_status',$request);
            
        });
      })
      ->when($request->income_from, function ($query, $request) {
        return $query->whereHas('borrower', function ($query) use ($request) {
          return $query->where('total_income','>=',$request);
            
        });
      })
      ->when($request->income_to, function ($query, $request) {
        return $query->whereHas('borrower', function ($query) use ($request) {
          return $query->where('total_income','<=',$request);
            
        });
      })
      ->when($request->barangay, function ($query, $request) {
        return $query->whereHas('borrower', function ($query) use ($request) {
          return $query->where('barangay',$request);
            
        });
      })
      ->when($request->city, function ($query, $request) {
        return $query->whereHas('borrower', function ($query) use ($request) {
          return $query->where('city',$request);
            
        });
      })
      ->orderBy('id', 'desc')
      ->get();

      // $data['date1']        = $request->date1;
      // $data['date2']        = $request->date2;
      // $data['status']       = $request->status;
      // $data['user_account'] = $request->user_account;
      // $data['loan_type']    = $request->loan_type;
      return view('backend.reports.additional', $data);

    }
  }
  public function loan_report(Request $request) {
    if ($request->isMethod('get')) {
      return view('backend.reports.loan_report');
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data         = array();
      $date1        = $request->date1;
      $date2        = $request->date2;
      $user_account = isset($request->user_account) ? $request->user_account : '';
      $status       = isset($request->status) ? $request->status : '';
      $loan_type    = isset($request->loan_type) ? $request->loan_type : '';

      $data['report_data'] = Loan::select('loans.*')
      ->with(['borrower', 'loan_product', 'currency'])
      ->when($status, function ($query, $status) {
        return $query->where('status', $status);
      }, function ($query, $status) {
        if ($status != '') {
          return $query->where('status', $status);
        }
      })
      ->when($loan_type, function ($query, $loan_type) {
        return $query->where('loan_product_id', $loan_type);
      })
      ->when($user_account, function ($query, $user_account) {
        return $query->whereHas('borrower', function ($query) use ($user_account) {
          return $query->where('email', $user_account)
          ->orWhere('account_number', $user_account);
        });
      })
      ->whereRaw("date(loans.created_at) >= '$date1' AND date(loans.created_at) <= '$date2'")
      ->orderBy('id', 'desc')
      ->get();

      $data['date1']        = $request->date1;
      $data['date2']        = $request->date2;
      $data['status']       = $request->status;
      $data['user_account'] = $request->user_account;
      $data['loan_type']    = $request->loan_type;
      return view('backend.reports.loan_report', $data);
    }

  }

  public function fdr_report(Request $request) {
    if ($request->isMethod('get')) {
      return view('backend.reports.fdr_report');
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data         = array();
      $date1        = $request->date1;
      $date2        = $request->date2;
      $user_account = isset($request->user_account) ? $request->user_account : '';
      $status       = isset($request->status) ? $request->status : '';
      $fdr_plan     = isset($request->fdr_plan) ? $request->fdr_plan : '';

      $data['report_data'] = FixedDeposit::select('fdrs.*')
      ->with(['plan', 'user', 'currency'])
      ->when($status, function ($query, $status) {
        return $query->where('status', $status);
      }, function ($query, $status) {
        if ($status != '') {
          return $query->where('status', $status);
        }
      })
      ->when($fdr_plan, function ($query, $fdr_plan) {
        return $query->where('loan_product_id', $fdr_plan);
      })
      ->when($user_account, function ($query, $user_account) {
        return $query->whereHas('user', function ($query) use ($user_account) {
          return $query->where('email', $user_account)
          ->orWhere('account_number', $user_account);
        });
      })
      ->whereRaw("date(fdrs.created_at) >= '$date1' AND date(fdrs.created_at) <= '$date2'")
      ->orderBy('id', 'desc')
      ->get();

      $data['date1']        = $request->date1;
      $data['date2']        = $request->date2;
      $data['status']       = $request->status;
      $data['user_account'] = $request->user_account;
      $data['fdr_plan']     = $request->fdr_plan;
      return view('backend.reports.fdr_report', $data);
    }

  }

  public function bank_revenues(Request $request) {
    if ($request->isMethod('get')) {
      return view('backend.reports.bank_revenues');
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data        = array();
      $year        = $request->year;
      $currency_id = $request->currency_id;

      $transaction_revenue = Transaction::selectRaw("CONCAT('Revenue from ', type), sum(fee) as amount")
      ->whereRaw("YEAR(created_at) = '$year'")
      ->where('fee', '!=', 0)
      ->where('status', 2)
      ->where('currency_id', $currency_id)
      ->groupBy('type');

      $data['report_data'] = LoanPayment::selectRaw("'Revenue from Loan' as type, sum(interest + late_penalties) as amount")
      ->whereRaw("YEAR(loan_payments.created_at) = '$year'")
      ->whereHas('loan', function ($query) use ($currency_id) {
        return $query->where('currency_id', $currency_id);
      })
      ->union($transaction_revenue)
      ->get();

      $data['year']        = $request->year;
      $data['currency_id'] = $request->currency_id;
      return view('backend.reports.bank_revenues', $data);
    }

  }
  public function soa(Request $request)
  {
    if ($request->isMethod('get')) {
      $data['company'] = User::where('user_type', 'company')->orderBy("users.id", "desc")->get();

      return view('backend.reports.soa',$data);
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data             = array();
      $date1            = $request->date1;
      $date2            = $request->date2;
      $company_id       = isset($request->company_id) ? $request->company_id : 0;
      $user_account     = isset($request->user_account) ? $request->user_account : '';
      $status           = isset($request->status) ? $request->status : '';
      $transaction_type = isset($request->transaction_type) ? $request->transaction_type : '';
      $current_date = date('Y-m-d');

      $data['report_data'] = DB::select("SELECT users.* , loans.loan_id as l_loan_id, loan_repayments.* FROM ((users INNER JOIN loans ON users.id = loans.borrower_id) INNER JOIN loan_repayments ON loans.id = loan_repayments.loan_id) WHERE users.company_id = $company_id AND loan_repayments.status = 0 AND loan_repayments.repayment_date >= '$date1' AND loan_repayments.repayment_date < '$date2'");
      
 
      $data['date1']            = $request->date1;
      $data['date2']            = $request->date2;
      $data['status']           = $request->status;
      $data['user_account']     = $request->user_account;
      $data['transaction_type'] = $request->transaction_type;
      $data['company_id']       = $request->company_id;
      $data['user_company'] = User::find($request->company_id);
      $data['statement'] = CompanySoaReports::orderBy('id','DESC')->first();

      $data['company'] = User::where('user_type', 'company')->orderBy("users.id", "desc")->get();

      // $comapny = User::find($request->company_id);
      // $data['client']           = ucfirst($comapny->company_name);
      // $data['contact_person']   = ucfirst($comapny->first_name.' '.$comapny->last_name);

      // return view('backend.reports.save_pdf',$data);
      return view('backend.reports.soa', $data);
    }
    
  }
  public function save_pdf(Request $request)
  {
    $data             = array();
    $date1            = $request->date1;
    $date2            = $request->date2;
    $company_id       = isset($request->company_id) ? $request->company_id : 0;

    $data['report_data'] = DB::select("SELECT users.* , loans.loan_id as l_loan_id, loan_repayments.* FROM ((users INNER JOIN loans ON users.id = loans.borrower_id) INNER JOIN loan_repayments ON loans.id = loan_repayments.loan_id) WHERE users.company_id = $company_id AND loan_repayments.status = 0 AND loan_repayments.repayment_date >= '$date1' AND loan_repayments.repayment_date < '$date2'");

    $comapny = User::find($company_id);

    $data['date1']            = $request->date1;
    $data['date2']            = $request->date2;
    $data['client']           = ucfirst($comapny->company_name);
    $data['contact_person']   = ucfirst($comapny->first_name.' '.$comapny->last_name);
    $last_report = CompanySoaReports::orderBy('id','DESC')->first();

    $data['statement']        = date('y').'-'.str_pad($last_report->id+1, 4, '0', STR_PAD_LEFT);


    $pdf = \PDF::loadView('backend.reports.save_pdf',$data);
    $path = public_path() . '/uploads/pdf';
    $fileName =  uniqid() . '.' . 'pdf' ;
    $pdf->save($path . '/' . $fileName);

    $report = new CompanySoaReports;
    $report->statement_id = $data['statement'];
    $report->report = $fileName;
    $report->company_id  = $company_id;
    $report->date = date('Y-m-d');  
    $report->save();
    return true;
  }
  public function soa_reports()
  {
    $reports = CompanySoaReports::all();
    return view('backend.reports.soa_reports',compact('reports'));
  }
  public function income_on_interest(Request $request)
  {
    if ($request->isMethod('get')) {
      $data['report_data'] = [];
      $data['company'] = User::where('user_type', 'company')->orderBy("users.id", "desc")->get();
      return view('backend.reports.income_on_interest',$data);
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data             = array();
      $date1            = $request->date1;
      $date2            = $request->date2;
      $company_id       = isset($request->company_id) ? $request->company_id : 0;
      $user_account     = isset($request->user_account) ? $request->user_account : '';
      $status           = isset($request->status) ? $request->status : '';
      $transaction_type = isset($request->transaction_type) ? $request->transaction_type : '';
      $current_date = date('Y-m-d');
      if($request->company_id == 'all')
        $data['report_data'] = DB::select("SELECT users.* , loans.loan_id as l_loan_id, loan_repayments.* FROM ((users INNER JOIN loans ON users.id = loans.borrower_id) INNER JOIN loan_repayments ON loans.id = loan_repayments.loan_id) WHERE  loan_repayments.status = 0 AND loan_repayments.repayment_date >= '$date1' AND loan_repayments.repayment_date < '$date2'");
      else
        $data['report_data'] = DB::select("SELECT users.* , loans.loan_id as l_loan_id, loan_repayments.* FROM ((users INNER JOIN loans ON users.id = loans.borrower_id) INNER JOIN loan_repayments ON loans.id = loan_repayments.loan_id) WHERE users.company_id = $company_id AND loan_repayments.status = 0 AND loan_repayments.repayment_date >= '$date1' AND loan_repayments.repayment_date < '$date2'");
      
 
      $data['date1']            = $request->date1;
      $data['date2']            = $request->date2;
      $data['status']           = $request->status;
      $data['user_account']     = $request->user_account;
      $data['transaction_type'] = $request->transaction_type;
      $data['company_id'] = $request->company_id;

      $data['company'] = User::where('user_type', 'company')->orderBy("users.id", "desc")->get();
      // return view('backend.reports.save_pdf',$data);
      return view('backend.reports.income_on_interest', $data);
    }

    
  }
  public function receivables(Request $request)
  {
    if ($request->isMethod('get')) {
      $data['company'] = User::where('user_type', 'company')->orderBy("users.id", "desc")->get();
      return view('backend.reports.receivables',$data);
    } else if ($request->isMethod('post')) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $data             = array();
      $date1            = $request->date1;
      $date2            = $request->date2;
      // $company_id       = isset($request->company_id) ? $request->company_id : 0;
      $user_account     = isset($request->user_account) ? $request->user_account : '';
      $status           = isset($request->status) ? $request->status : '';
      $transaction_type = isset($request->transaction_type) ? $request->transaction_type : '';
      $current_date = date('Y-m-d');

      $data['report_data'] = DB::select("SELECT users.* , loans.loan_id as l_loan_id,loans.*, loan_repayments.* FROM ((users INNER JOIN loans ON users.id = loans.borrower_id) INNER JOIN loan_repayments ON loans.id = loan_repayments.loan_id) WHERE loan_repayments.status = 0 AND loan_repayments.repayment_date >= '$date1' AND loan_repayments.repayment_date < '$date2'");
 
      $data['date1']            = $request->date1;
      $data['date2']            = $request->date2;
      $data['status']           = $request->status;
      $data['user_account']     = $request->user_account;
      $data['transaction_type'] = $request->transaction_type;
      $data['company_id']       = $request->company_id;
      $data['user_company'] = User::find($request->company_id);
      $data['statement'] = CompanySoaReports::orderBy('id','DESC')->first();

      $data['company'] = User::where('user_type', 'company')->orderBy("users.id", "desc")->get();

      // $comapny = User::find($request->company_id);
      // $data['client']           = ucfirst($comapny->company_name);
      // $data['contact_person']   = ucfirst($comapny->first_name.' '.$comapny->last_name);

      // return view('backend.reports.save_pdf',$data);
      return view('backend.reports.receivables', $data);
    }
  }
}