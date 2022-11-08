<?php

namespace App\Http\Controllers;

use Hash;
use DataTables;
use App\Models\Loan;
use App\Models\User;
use App\Mail\GeneralMail;
use App\Models\Document;
use App\Utilities\Overrider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;
use Barryvdh\DomPDF\Facade;

class CompanyController extends Controller
{

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
        return view('backend.company.list', compact('status'));
    }

    public function get_table_data($status = 'all') {
        $users = User::select('users.*')
            ->where('user_type', 'company')
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
                } else if ($status == 'active') {
                    return $query->where('status', 1);
                }
            })
            ->orderBy("users.id", "desc");

        return Datatables::eloquent($users)
            ->editColumn('company_name', function ($user) {
                return $user->company_name;
            })
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
            ->addColumn('borrowers', function ($user) {
                return '<a href="' . route('borrower_list', $user['id']) . '" class="btn btn-primary btn-sm"><i class="icofont-eye-alt"></i></a>';
            })
            ->addColumn('action', function ($user) {
                return '<div class="text-center"><form action="' . action('CompanyController@destroy', $user['id']) . '" class="text-center" method="post">'
                . '<a href="' . action('CompanyController@show', $user['id']) . '" class="btn btn-primary btn-sm"><i class="icofont-eye-alt"></i></a>&nbsp;'
                . '<a href="' . action('CompanyController@edit', $user['id']) . '" data-title="' . _lang('Update User') . '" class="btn btn-warning btn-sm ajax-modal"><i class="icofont-ui-edit"></i></a>&nbsp;'
                . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="btn btn-danger btn-sm btn-remove" type="submit"><i class="icofont-trash"></i></button>'
                    . '</form></div>';
            })
            ->setRowId(function ($user) {
                return "row_" . $user->id;
            })
            ->rawColumns(['status', 'profile_picture', 'document_verified_at', 'email_verified_at', 'sms_verified_at','borrowers', 'action'])
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
    public function randomString()
    {
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randStr = substr(str_shuffle($str_result),0,1);
        $str_result = '0123456789';
        $randNum = substr(str_shuffle($str_result),0,4);

        return $randStr.$randNum;
    }
    public function create(Request $request) {
        
        code:
        $company_code = $this->randomString();
        $prev_comp = User::where('company_code',$company_code)->first();
        if($prev_comp)
            goto code;

        if (!$request->ajax()) {
            return view('backend.company.create',compact('company_code'));
        } else {
            return view('backend.company.modal.create',compact('company_code'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|max:255',
            'last_name'      => 'required|max:255',
            'email'          => 'required|email|unique:users|max:255',
            'company_code'   => 'required|max:5',
            'company_name'   => 'required|max:255',
            'company_address'=> 'required|max:255',
            'company_phone'  => 'required|max:255',
            'company_email'  => 'required|max:255',
            'company_name'   => 'required|max:255',
            'country_code'   => 'required',
            'contact_info'   => 'required',
            'phone'          => 'required',
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
        $user->company_code      = $request->input('company_code');
        $user->company_name      = $request->input('company_name');
        $user->company_address   = $request->input('company_address');
        $user->company_phone     = $request->input('company_phone');
        $user->company_email     = $request->input('company_email');
        $user->contact_info      = $request->input('contact_info');
        $user->email             = $request->input('email');
        $user->country_code      = $request->input('country_code');
        $user->phone             = $request->input('phone');
        $user->user_type         = 'company';
        $user->status            = $request->input('status');
        $user->profile_picture   = $profile_picture;
        $user->email_verified_at = $request->email_verified_at;
        $user->sms_verified_at   = $request->sms_verified_at;
        $user->password          = Hash::make($request->password);

        $user->save();

        //Prefix Output
        $user->status          = status($user->status);
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
        if (!$request->ajax()) {
            return view('backend.company.view', compact('user', 'id'));
        } else {
            return view('backend.company.modal.view', compact('user', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $user = User::find($id);
        if (!$request->ajax()) {
            return view('backend.company.edit', compact('user', 'id'));
        } else {
            return view('backend.company.modal.edit', compact('user', 'id'));
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
            'first_name'             => 'required|max:255',
            'last_name'             => 'required|max:255',
            'email'            => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'company_code'   => 'required|max:5',
            'company_address'=> 'required|max:255',
            'company_phone'  => 'required|max:255',
            'company_email'  => 'required|max:255',
            'company_name'   => 'required|max:255',
            'country_code'   => 'required',
            'contact_info'   => 'required',
            'status'           => 'required',
            'profile_picture'  => 'nullable|image',
            'password'         => 'nullable|min:6',
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
        $user->company_name      = $request->input('company_name');
        $user->company_address   = $request->input('company_address');
        $user->company_phone     = $request->input('company_phone');
        $user->company_email     = $request->input('company_email');
        $user->contact_info      = $request->input('contact_info');
        $user->email             = $request->input('email');
        $user->phone             = $request->input('phone');
        $user->country_code     = $request->input('country_code');
        $user->phone            = $request->input('phone');
        $user->status           = $request->input('status');
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
        $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

        if (!$request->ajax()) {
            return redirect()->route('companies.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $user, 'table' => '#users_table']);
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
        return redirect()->route('companies.index')->with('success', _lang('Deleted successfully'));
    }

    public function endoremetRequest(Request $request){

        $loans = Loan::join('users','users.id',"borrower_id")
                    ->where("users.company_id",auth()->user()->id)
                    ->where("endoresment_required",true)
                    ->where("users.verified",0)
                    ->select('*','users.id as uid','loans.id as id','users.first_name as first_name','users.middle_name as middle_name','users.last_name as last_name','loans.applied_amount as applied_amount')->get();

        return view('backend.company.endoresments.endoresments', compact('loans'));
    }

    public function approveRequest(Request $request)
    {
        $this->validate($request,[
            'id'           => 'required',
            'salary'       => 'required',
            'e_signatures' => 'required|mimes:jpg,jpeg,png'
        ]);
        
        $signature = "";
        if ($request->hasfile('e_signatures')) {
            $file     = $request->file('e_signatures');
            $signature = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/", $signature);
        }

        $loan = Loan::find($request->id);
        $loan->endoresment_required = false;
        $loan->save();

        $user = User::where('id',$loan->borrower_id)->first();
        $user->verified = 1;
        

        $data['user_name'] = $user->name;
        $data['salary'] = $request->salary;
        $data['loan'] = $loan->applied_amount;
        $data['date'] = date('d-m-Y');
        $data['signature'] = $signature;

        $pdf = \PDF::loadView('endorsement_letter',compact('data'));
        $path = public_path() . '/uploads/pdf';
        $fileName =  uniqid() . '.' . 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $user->company_e_signature = $fileName;
        $user->save();
        

        return redirect()->back()->withSuccess("Endoresment Approve Successfully.");
    }
    public function borrower_list(Request $request,$id)
    {
        $browsers = User::where('company_id',$id)->get();
        return view('backend.company.borrower_list',compact('browsers'));
    }
}
