<?php

namespace App\Http\Controllers;

use App\Models\LoanPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanPurposeController extends Controller
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
    public function index() {
        $loanPurposes = LoanPurpose::all()->sortByDesc("id");
        return view('backend.loan_purpose.list', compact('loanPurposes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return view('backend.loan_purpose.create');
        } else {
            return view('backend.loan_purpose.modal.create');
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
            'name'                    => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loan_purpose.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $loanPurpose                          = new LoanPurpose();
        $loanPurpose->name                    = $request->input('name');

        $loanPurpose->save();

        if (!$request->ajax()) {
            return redirect()->route('loan_purpose.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $loanPurpose, 'table' => '#loan_purpose_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $loanPurpose = LoanPurpose::find($id);
        if (!$request->ajax()) {
            return view('backend.loan_purpose.view', compact('loanPurpose', 'id'));
        } else {
            return view('backend.loan_purpose.modal.view', compact('loanPurpose', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $loanPurpose = LoanPurpose::find($id);
        if (!$request->ajax()) {
            return view('backend.loan_purpose.edit', compact('loanPurpose', 'id'));
        } else {
            return view('backend.loan_purpose.modal.edit', compact('loanPurpose', 'id'));
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
            'name'                    => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loan_purpose.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $loanPurpose                          = LoanPurpose::find($id);
        $loanPurpose->name                    = $request->input('name');

        $loanPurpose->save();

        if (!$request->ajax()) {
            return redirect()->route('loan_purpose.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $loanPurpose, 'table' => '#loan_purpose_table']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $loanPurpose = LoanPurpose::find($id);
        $loanPurpose->delete();
        return redirect()->route('loan_purpose.index')->with('success', _lang('Deleted Successfully'));
    }
}
