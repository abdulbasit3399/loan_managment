<?php

namespace App\Http\Controllers;

use App\Mail\GeneralMail;
use App\Models\Document;
use App\Models\User;
use App\Utilities\Overrider;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;

class UserController extends Controller {

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
    public function index($status = 'all') {
      return view('backend.user.list', compact('status'));
    }

    public function get_table_data($status = 'all') {

      $users = User::select('users.*')
      ->with('branch')
      ->where('user_type', 'customer')
      ->when($status, function ($query, $status) {
        if ($status == 'email_verified') {
          return $query->where('email_verified_at', '!=', null);
        } else if ($status == 'sms_verified') {
          return $query->where('sms_verified_at', '!=', null);
        } else if ($status == 'email_unverified') {
          return $query->where('email_verified_at', null);
        } else if ($status == 'sms_unverified') {
          return $query->where('sms_verified_at', null);
        } else if ($status == 'inactive') {
          return $query->where('status', 0);
        } else if ($status == 'endorsemented') {
          return $query->where([['status', 1],['verified',1],['company_e_signature','!=',null]]);
        } else if ($status == 'active') {
          return $query->where('status', 1);
        }
      })
      ->orderBy("users.id", "desc");

      return Datatables::eloquent($users)
      ->editColumn('phone', function ($user) {
        return '+' . $user->country_code . '-' . $user->phone;
      })
      ->editColumn('status', function ($user) {
        return status($user->status);
      })
      ->addColumn('profile_picture', function ($user) {
        return '<img class="thumb-sm img-thumbnail"
        src="' . profile_picture($user->profile_picture) . '">';
      })
      ->editColumn('document_verified_at', function ($user) {
        return $user->document_verified_at != null ? show_status(_lang('Yes'), 'primary') : show_status(_lang('No'), 'danger');
      })
      ->editColumn('email_verified_at', function ($user) {
        return $user->email_verified_at != null ? show_status(_lang('Yes'), 'primary') : show_status(_lang('No'), 'danger');
      })
      ->addColumn('action', function ($user) {
        return '<div class="text-center"><form action="' . action('UserController@destroy', $user['id']) . '" class="text-center" method="post">'
        . '<a href="' . action('UserController@show', $user['id']) . '" class="btn btn-primary btn-sm"><i class="icofont-eye-alt"></i></a>&nbsp;'
                // . '<a href="' . action('UserController@edit', $user['id']) . '" data-title="' . _lang('Update User') . '" class="btn btn-warning btn-sm ajax-modal"><i class="icofont-ui-edit"></i></a>&nbsp;'
        . '<a href="' . action('UserController@edit', $user['id']) . '" data-title="' . _lang('Update User') . '" class="btn btn-warning btn-sm"><i class="icofont-ui-edit"></i></a>&nbsp;'
        . csrf_field()
        . '<input name="_method" type="hidden" value="DELETE">'
        . '<button class="btn btn-danger btn-sm btn-remove" type="submit"><i class="icofont-trash"></i></button>'
        . '</form></div>';
      })
      ->setRowId(function ($user) {
        return "row_" . $user->id;
      })
      ->rawColumns(['status', 'profile_picture', 'document_verified_at', 'email_verified_at', 'sms_verified_at', 'action'])
      ->make(true);
    }

    /**
     * Display a listing of users Documents.
     *
     * @return \Illuminate\Http\Response
     */

    public function documents() {
      $users = User::where('user_type', 'customer')
      ->where('document_submitted_at', '!=', null)
      ->where('document_verified_at', null)
      ->has('documents')->get();

      return view('backend.user.documents', compact('users'));
    }

    /**
     * Display single users Documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_documents($user_id) {
      $documents = Document::where('user_id', $user_id)->get();
      $user      = User::find($user_id);
      return view('backend.user.view_documents', compact('documents', 'user'));
    }

    /**
     * Varify User account.
     *
     * @return \Illuminate\Http\Response
     */
    public function varify($user_id) {
      $user                       = User::find($user_id);
      $user->document_verified_at = now();
      $user->save();

        //Send Email/Notification to customer

        //Redirect to back
      return back()->with('varified_success', _lang('Account Verified'));
    }

    /**
     * Unvarify User account.
     *
     * @return \Illuminate\Http\Response
     */
    public function unvarify($user_id) {
      $user                        = User::find($user_id);
      $user->document_verified_at  = null;
      $user->document_submitted_at = null;
      $user->save();

        //Send Email/Notification to customer

        //Redirect to back
      return back()->with('varified_success', _lang('Account Unverified'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
      $companies = User::select('users.*')
      ->where('user_type', 'company')->get();
      if (!$request->ajax()) {
        return view('backend.user.create',compact('companies'));
      } else {
        return view('backend.user.modal.create',compact('companies'));
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
        'first_name'            => 'required|max:255',
        'last_name'            => 'required|max:255',
        'email'           => 'required|email|unique:users|max:255',
            // 'account_number'  => 'required|max:30|unique:users',
            // 'branch_id'       => 'required',
        'status'          => 'required',
        'profile_picture' => 'nullable|image',
        'password'        => 'required|min:6',
      ]);

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return redirect()->route('users.create')
          ->withErrors($validator)
          ->withInput();
        }
      }

      $profile_picture = "";
      if ($request->hasfile('profile_picture')) {
        $file            = $request->file('profile_picture');
        $profile_picture = time() . $file->getClientOriginalName();
        $file->move(public_path() . "/uploads/profile/", $profile_picture);
      }

      $user                    = new User();
      $user->first_name        = $request->input('first_name');
      $user->middle_name       = $request->input('middle_name');
      $user->last_name         = $request->input('last_name');
      $user->email             = $request->input('email');
      $user->country_code      = $request->input('country_code');
      $user->phone             = $request->input('phone');
      $user->company_id        = $request->input('company_id');
      $user->dob              = $request->input('dob');
      $user->home_address = $request->input('home_address');
      $user->spouse_first_name = $request->input('spouse_first_name');
      $user->spouse_middle_name = $request->input('spouse_middle_name');
      $user->spouse_last_name = $request->input('spouse_last_name');
      $user->marital_status = $request->input('marital_status');
      $user->present_employer_name = $request->input('present_employer_name') ? $request->input('present_employer_name') : '';
      $user->present_employer_address = $request->input('present_employer_address') ? $request->input('present_employer_address') : '';
      $user->present_employer_position = $request->input('present_employer_position') ? $request->input('present_employer_position') : '';
      $user->present_employer_since = $request->input('present_employer_since') ? $request->input('present_employer_since') : '';
      $user->present_employer_phone = $request->input('present_employer_phone') ? $request->input('present_employer_phone') : '';
      $user->previous_employer_name = $request->input('previous_employer_name') ? $request->input('previous_employer_name') : '';
      $user->previous_employer_address = $request->input('previous_employer_address') ? $request->input('previous_employer_address') : '';
      $user->previous_employer_position = $request->input('previous_employer_position') ? $request->input('previous_employer_position') : '';
      $user->previous_employer_since = $request->input('previous_employer_since') ? $request->input('previous_employer_since') : '';
      $user->previous_employer_phone = $request->input('previous_employer_phone') ? $request->input('previous_employer_phone') : '';
      $user->spouse_present_employer_name = $request->input('spouse_present_employer_name') ? $request->input('spouse_present_employer_name') : '';
      $user->spouse_present_employer_address = $request->input('spouse_present_employer_address') ? $request->input('spouse_present_employer_address') : '';
      $user->spouse_present_employer_position = $request->input('spouse_present_employer_position') ? $request->input('spouse_present_employer_position') : '';
      $user->spouse_present_employer_since = $request->input('spouse_present_employer_since') ? $request->input('spouse_present_employer_since') : '';
      $user->spouse_present_employer_phone = $request->input('spouse_present_employer_phone') ? $request->input('spouse_present_employer_phone') : '';
      $user->spouse_previous_employer_name = $request->input('spouse_previous_employer_name') ? $request->input('spouse_previous_employer_name') : '';
      $user->spouse_preious_employer_address = $request->input('spouse_preious_employer_address') ? $request->input('spouse_preious_employer_address') : '';
      $user->spouse_previous_employer_position = $request->input('spouse_previous_employer_position') ? $request->input('spouse_previous_employer_position') : '';
      $user->spouse_previous_employer_since = $request->input('spouse_previous_employer_since') ? $request->input('spouse_previous_employer_since') : '';
      $user->spouse_previous_employer_phone = $request->input('spouse_previous_employer_phone') ? $request->input('spouse_previous_employer_phone') : '';
      $user->sbu_department = $request->input('sbu_department') ? $request->input('sbu_department') : '';
      $user->own_salary = $request->input('own_salary') ? $request->input('own_salary') : '';
      $user->present_length_service = $request->input('present_length_service') ? $request->input('present_length_service') : '';
      $user->other_income = $request->input('other_income') ? $request->input('other_income') : '';
      $user->total_income = $request->input('total_income') ? $request->input('total_income') : '';
      $user->fixed_obligations = $request->input('fixed_obligations') ? $request->input('fixed_obligations') : '';
      $user->other_living_expense = $request->input('other_living_expense') ? $request->input('other_living_expense') : '';
      $user->net_monthly_income = $request->input('net_monthly_income') ? $request->input('net_monthly_income') : '';
      $user->refference_first_name = $request->input('refference_first_name') ? $request->input('refference_first_name') : '';
      $user->refference_last_name = $request->input('refference_last_name') ? $request->input('refference_last_name') : '';
      $user->refference_company_name = $request->input('refference_company_name') ? $request->input('refference_company_name') : '';
      $user->refference_position = $request->input('refference_position') ? $request->input('refference_position') : '';
      $user->refference_address = $request->input('refference_address') ? $request->input('refference_address') : '';
      $user->refference_mobile = $request->input('refference_mobile') ? $request->input('refference_mobile') : '';
      $user->spouse_middle_name = $request->input('spouse_middle_name') ? $request->input('spouse_middle_name') : '';
      $user->spouse_middle_name = $request->input('spouse_middle_name') ? $request->input('spouse_middle_name') : '';
      $user->spouse_middle_name = $request->input('spouse_middle_name') ? $request->input('spouse_middle_name') : '';

        // $user->account_number    = $request->input('account_number');
      $user->user_type         = 'customer';
        // $user->branch_id         = $request->branch_id;
      $user->status            = $request->input('status');
      $user->profile_picture   = $profile_picture;
      $user->email_verified_at = $request->email_verified_at;
      $user->sms_verified_at   = $request->sms_verified_at;
      $user->password          = Hash::make($request->password);

      $user->save();

        //Prefix Output
      $user->status          = status($user->status);
        // $user->branch_id       = $user->branch->name;
      $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

      if (!$request->ajax()) {
        return redirect()->route('users.create')->with('success', _lang('Saved successfully'));
      } else {
        return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $user, 'table' => '#users_table']);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
      $user            = User::find($id);
      $comapny = '';
      if($user->company_id && $user->company_id != 0){

        $get_comp = User::find($user->company_id);
        if($get_comp)
          $comapny = $get_comp->company_name;
      }


      $account_balance = DB::select("SELECT currency.*, (SELECT IFNULL(SUM(amount), 0) FROM transactions
        WHERE dr_cr = 'cr' AND currency_id = currency.id AND status != 0 AND transactions.user_id = " . $user->id . ") - (SELECT IFNULL(SUM(amount),0)
        FROM transactions WHERE dr_cr = 'dr' AND currency_id = currency.id AND status != 0 AND transactions.user_id = " . $user->id . ") as balance
        FROM currency LEFT JOIN transactions ON currency.id=transactions.currency_id WHERE currency.status=1 GROUP BY currency.id");
      if (!$request->ajax()) {
        return view('backend.user.view', compact('user', 'id', 'account_balance','comapny'));
      } else {
        return view('backend.user.modal.view', compact('user', 'id', 'account_balance','comapny'));
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
      $companies = User::select('users.*')
      ->where('user_type', 'company')->get();
      $user = User::find($id);
      if (!$request->ajax()) {
        return view('backend.user.edit', compact('user', 'id','companies'));
      } else {
        return view('backend.user.modal.edit', compact('user', 'id','companies'));
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
        'email'            => [
          'required',
          'email',
          Rule::unique('users')->ignore($id),
        ],
            // 'account_number'   => [
            //     'required',
            //     'max:30',
            //     Rule::unique('users')->ignore($id),
            // ],
        'status'           => 'required',
        'profile_picture'  => 'nullable|image',
        'password'         => 'nullable|min:6',
        'allow_withdrawal' => 'required',
      ]);

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return redirect()->route('users.edit', $id)
          ->withErrors($validator)
          ->withInput();
        }
      }

      if ($request->hasfile('profile_picture')) {
        $file            = $request->file('profile_picture');
        $profile_picture = time() . $file->getClientOriginalName();
        $file->move(public_path() . "/uploads/profile/", $profile_picture);
      }
      $user                   = User::find($id);
      $user->first_name        = $request->input('first_name');
      $user->middle_name       = $request->input('middle_name');
      $user->last_name         = $request->input('last_name');
      $user->email            = $request->input('email');
      $user->country_code     = $request->input('country_code');
      $user->phone            = $request->input('phone');
      $user->company_id       = $request->input('company_id');
      $user->dob              = $request->input('dob');
      $user->home_address = $request->input('home_address');
      $user->spouse_first_name = $request->input('spouse_first_name');
      $user->spouse_middle_name = $request->input('spouse_middle_name');
      $user->spouse_last_name = $request->input('spouse_last_name');
      $user->marital_status = $request->input('marital_status');
      $user->present_employer_name = $request->input('present_employer_name') ? $request->input('present_employer_name') : '';
      $user->present_employer_address = $request->input('present_employer_address') ? $request->input('present_employer_address') : '';
      $user->present_employer_position = $request->input('present_employer_position') ? $request->input('present_employer_position') : '';
      $user->present_employer_since = $request->input('present_employer_since') ? $request->input('present_employer_since') : '';
      $user->present_employer_phone = $request->input('present_employer_phone') ? $request->input('present_employer_phone') : '';
      $user->previous_employer_name = $request->input('previous_employer_name') ? $request->input('previous_employer_name') : '';
      $user->previous_employer_address = $request->input('previous_employer_address') ? $request->input('previous_employer_address') : '';
      $user->previous_employer_position = $request->input('previous_employer_position') ? $request->input('previous_employer_position') : '';
      $user->previous_employer_since = $request->input('previous_employer_since') ? $request->input('previous_employer_since') : '';
      $user->previous_employer_phone = $request->input('previous_employer_phone') ? $request->input('previous_employer_phone') : '';
      $user->spouse_present_employer_name = $request->input('spouse_present_employer_name') ? $request->input('spouse_present_employer_name') : '';
      $user->spouse_present_employer_address = $request->input('spouse_present_employer_address') ? $request->input('spouse_present_employer_address') : '';
      $user->spouse_present_employer_position = $request->input('spouse_present_employer_position') ? $request->input('spouse_present_employer_position') : '';
      $user->spouse_present_employer_since = $request->input('spouse_present_employer_since') ? $request->input('spouse_present_employer_since') : '';
      $user->spouse_present_employer_phone = $request->input('spouse_present_employer_phone') ? $request->input('spouse_present_employer_phone') : '';
      $user->spouse_previous_employer_name = $request->input('spouse_previous_employer_name') ? $request->input('spouse_previous_employer_name') : '';
      $user->spouse_preious_employer_address = $request->input('spouse_preious_employer_address') ? $request->input('spouse_preious_employer_address') : '';
      $user->spouse_previous_employer_position = $request->input('spouse_previous_employer_position') ? $request->input('spouse_previous_employer_position') : '';
      $user->spouse_previous_employer_since = $request->input('spouse_previous_employer_since') ? $request->input('spouse_previous_employer_since') : '';
      $user->spouse_previous_employer_phone = $request->input('spouse_previous_employer_phone') ? $request->input('spouse_previous_employer_phone') : '';
      $user->sbu_department = $request->input('sbu_department') ? $request->input('sbu_department') : '';
      $user->own_salary = $request->input('own_salary') ? $request->input('own_salary') : '';
      $user->present_length_service = $request->input('present_length_service') ? $request->input('present_length_service') : '';
      $user->other_income = $request->input('other_income') ? $request->input('other_income') : '';
      $user->total_income = $request->input('total_income') ? $request->input('total_income') : '';
      $user->fixed_obligations = $request->input('fixed_obligations') ? $request->input('fixed_obligations') : '';
      $user->other_living_expense = $request->input('other_living_expense') ? $request->input('other_living_expense') : '';
      $user->net_monthly_income = $request->input('net_monthly_income') ? $request->input('net_monthly_income') : '';
      $user->refference_first_name = $request->input('refference_first_name') ? $request->input('refference_first_name') : '';
      $user->refference_last_name = $request->input('refference_last_name') ? $request->input('refference_last_name') : '';
      $user->refference_company_name = $request->input('refference_company_name') ? $request->input('refference_company_name') : '';
      $user->refference_position = $request->input('refference_position') ? $request->input('refference_position') : '';
      $user->refference_address = $request->input('refference_address') ? $request->input('refference_address') : '';
      $user->refference_mobile = $request->input('refference_mobile') ? $request->input('refference_mobile') : '';
      $user->spouse_middle_name = $request->input('spouse_middle_name') ? $request->input('spouse_middle_name') : '';
      $user->spouse_middle_name = $request->input('spouse_middle_name') ? $request->input('spouse_middle_name') : '';
      $user->spouse_middle_name = $request->input('spouse_middle_name') ? $request->input('spouse_middle_name') : '';
        // $user->account_number   = $request->input('account_number');
      $user->status           = $request->input('status');
        // $user->branch_id        = $request->branch_id;
      $user->allow_withdrawal = $request->allow_withdrawal;
      if ($request->hasfile('profile_picture')) {
        $user->profile_picture = $profile_picture;
      }
      if ($request->password) {
        $user->password = Hash::make($request->password);
      }

      $user->email_verified_at = $request->email_verified_at;
      $user->sms_verified_at   = $request->sms_verified_at;

      $user->save();

        //Prefix Output
      $user->status          = status($user->status);
      $user->branch_id       = $user->branch->name;
      $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

      if (!$request->ajax()) {
        return redirect()->route('users.index')->with('success', _lang('Updated successfully'));
      } else {
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $user, 'table' => '#users_table']);
      }

    }

    public function send_email(Request $request) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      Overrider::load("Settings");

      $validator = Validator::make($request->all(), [
        'user_email' => 'required',
        'subject'    => 'required',
        'message'    => 'required',
      ]);

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return back()->withErrors($validator)
          ->withInput();
        }
      }

        //Send email
      $subject = $request->input("subject");
      $message = $request->input("message");

      $mail          = new \stdClass();
      $mail->subject = $subject;
      $mail->body    = $message;

      try {
        Mail::to($request->user_email)
        ->send(new GeneralMail($mail));
      } catch (\Exception $e) {
        if (!$request->ajax()) {
          return back()->with('error', _lang('Sorry, Error Occured !'));
        } else {
          return response()->json(['result' => 'error', 'message' => _lang('Sorry, Error Occured !')]);
        }
      }

      if (!$request->ajax()) {
        return back()->with('success', _lang('Email Send Sucessfully'));
      } else {
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Email Send Sucessfully'), 'data' => $contact]);
      }
    }

    public function send_sms(Request $request) {
      @ini_set('max_execution_time', 0);
      @set_time_limit(0);

      Overrider::load("Settings");

      $validator = Validator::make($request->all(), [
        'phone'   => 'required',
        'message' => 'required:max:160',
      ]);

      if ($validator->fails()) {
        if ($request->ajax()) {
          return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        } else {
          return back()->withErrors($validator)
          ->withInput();
        }
      }

        //Send message
      $message = $request->input("message");

      if (get_option('enable_sms') == 0) {
        return back()->with('error', _lang('Sorry, SMS not enabled !'));
      }

      $account_sid   = get_option('twilio_account_sid');
      $auth_token    = get_option('twilio_auth_token');
      $twilio_number = get_option('twilio_mobile_number');
      $client        = new Client($account_sid, $auth_token);

      try {
        $client->messages->create($request->phone,
          ['from' => $twilio_number, 'body' => $message]);
      } catch (\Exception $e) {
        if (!$request->ajax()) {
          return back()->with('error', _lang('Sorry, Error Occured !'));
        } else {
          return response()->json(['result' => 'error', 'message' => _lang('Sorry, Error Occured !')]);
        }
      }

      if (!$request->ajax()) {
        return back()->with('success', _lang('SMS Send Sucessfully'));
      } else {
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('SMS Send Sucessfully'), 'data' => $contact]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $user = User::find($id);
      $user->delete();
      return redirect()->route('users.index')->with('success', _lang('Deleted successfully'));
    }
  }