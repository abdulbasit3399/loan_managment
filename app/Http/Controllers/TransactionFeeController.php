<?php

namespace App\Http\Controllers;

use App\Models\TransactionFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionFeeController extends Controller
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
        $transactionFees = TransactionFee::all()->sortByDesc("id");
        return view('backend.transaction_fees.list', compact('transactionFees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return view('backend.transaction_fees.create');
        } else {
            return view('backend.transaction_fees.modal.create');
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
            'name'        => 'required',
            'type'        => 'required',
            'amount'      => 'required',
            'amount_from' => 'required',
            'amount_to'   => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('transaction_fees.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $transactionFee                          = new TransactionFee();
        $transactionFee->name                    = $request->input('name');
        $transactionFee->type                    = $request->input('type');
        $transactionFee->amount                  = $request->input('amount');
        $transactionFee->amount_from             = $request->input('amount_from');
        $transactionFee->amount_to               = $request->input('amount_to');

        $transactionFee->save();

        if (!$request->ajax()) {
            return redirect()->route('transaction_fees.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $transactionFee, 'table' => '#transaction_fees_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $transactionFee = TransactionFee::find($id);
        if (!$request->ajax()) {
            return view('backend.transaction_fees.view', compact('transactionFee', 'id'));
        } else {
            return view('backend.transaction_fees.modal.view', compact('transactionFee', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $transactionFee = TransactionFee::find($id);
        if (!$request->ajax()) {
            return view('backend.transaction_fees.edit', compact('transactionFee', 'id'));
        } else {
            return view('backend.transaction_fees.modal.edit', compact('transactionFee', 'id'));
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
            'type'                    => 'required',
            'amount'                  => 'required',
            'amount_from'             => 'required',
            'amount_to'               => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('transaction_fees.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $transactionFee                          = TransactionFee::find($id);
        $transactionFee->name                    = $request->input('name');
        $transactionFee->type                    = $request->input('type');
        $transactionFee->amount                  = $request->input('amount');
        $transactionFee->amount_from             = $request->input('amount_from');
        $transactionFee->amount_to               = $request->input('amount_to');

        $transactionFee->save();

        if (!$request->ajax()) {
            return redirect()->route('transaction_fees.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $transactionFee, 'table' => '#transaction_fees_table']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $transactionFee = TransactionFee::find($id);
        $transactionFee->delete();
        return redirect()->route('transaction_fees.index')->with('success', _lang('Deleted Successfully'));
    }
}
