<style type="text/css">
	table.table-bordered.dataTable {
    border-right-width: 0;
}
table.dataTable {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    border-collapse: separate !important;
    border-spacing: 0;
}
.table-bordered {
    border: 1px solid #dee2e6;
}
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #f4f4f5;
}
.table-bordered thead th, .table-bordered thead td {
    border-bottom-width: 2px;
}
table.table-bordered.dataTable th, table.table-bordered.dataTable td {
    border-left-width: 0;
}
.table th {
    background-color: whitesmoke !important;
    color: #000;
}
.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6;
}
.table th, .table td {
    padding: 0.75rem;
}
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td.dtr-control, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th.dtr-control {
    position: relative;
    padding-left: 30px;
    cursor: pointer;
}
.table td {
    color: #2d2d2d;
    vertical-align: middle;
}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
}
table.table-bordered.dataTable th, table.table-bordered.dataTable td {
    border-left-width: 0;
}
.text-danger {
    color: #dc3545 !important;
}
.text-success {
    color: #28a745 !important;
}

</style>


<div class="report-header">
	
	<table class="table">
		<tbody>
			<tr>
				<td><b>Client:&nbsp;</b>{{$client}}</td>
				<td style="text-align:right;"><b><b>Statement #:&nbsp;</b>{{$statement}}</td>
			</tr>
			<tr>
				<td><b>Contact Person:&nbsp;</b>{{$contact_person}}</td>
				<td style="text-align:right;"><b>Date: &nbsp;</b>{{date('Y-m-d')}}</td>
			</tr>
		</tbody>
	</table>
	
</div>

<table class="table table-bordered report-table" style="clear: left;clear: right;">
	<thead>
		<th>{{ _lang('Loan ID') }}</th>
		<th>{{ _lang('Date') }}</th>
		<th>{{ _lang('Borrower') }}</th>
		<th>{{ _lang('Penalty') }}</th>
		<th>{{ _lang('Amount to Pay') }}</th>
		<th>{{ _lang('Amount Due') }}</th>
	</thead>
	<tbody>
		@php
		$total_due = 0;
		if(isset($report_data)):
		foreach($report_data as $transaction):
			$total_due += $transaction->amount_to_pay + $transaction->penalty;
		@endphp
		<tr>
			<td>{{$transaction->l_loan_id}}</td>
			<td>{{$transaction->repayment_date}}</td>
			<td>
				{{$transaction->name != '' ? $transaction->name : $transaction->first_name.' '.$transaction->last_name }}
			</td>
			<td>{{$transaction->penalty}}</td>
			<td>{{$transaction->amount_to_pay}}</td>
			<td>{{$transaction->amount_to_pay + $transaction->penalty}}</td>
		</tr>
		@endforeach
		@endif
		<tr>
			<td colspan="2"><b>Account Current Balance</b></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>{{$total_due}}</b></td>
		</tr>
	</tbody>
</table>