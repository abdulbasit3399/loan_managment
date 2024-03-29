@extends('layouts.app')

@section('content')
@php $permissions = permission_list(); @endphp
<div class="row">

	@if (in_array('dashboard.active_users_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-primary">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Active Users') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ $active_customer }}</b></h6>
					</div>
					<div>
						<a href="{{ route('users.filter') }}/active"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if (in_array('dashboard.pending_kyc_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-danger">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Pending KYC') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ kyc_count(false) }}</b></h6>
					</div>
					<div>
						<a href="{{ route('users.documents') }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if (in_array('dashboard.pending_tickets_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-info">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Pending Tickets') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ request_count('pending_tickets') }}</b></h6>
					</div>
					<div>
						<a href="{{ route('support_tickets.index',['status' => 'pending']) }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif


	@if (in_array('dashboard.deposit_requests_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-primary">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Deposit Requests') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ request_count('deposit_requests') }}</b></h6>
					</div>
					<div>
						<a href="{{ route('deposit_requests.index') }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if (in_array('dashboard.withdraw_requests_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-secondary">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Withdraw Requests') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ request_count('withdraw_requests') }}</b></h6>
					</div>
					<div>
						<a href="{{ route('withdraw_requests.index') }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if (in_array('dashboard.loan_requests_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-success">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Loan Requests') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ request_count('pending_loans') }}</b></h6>
					</div>
					<div>
						<a href="{{ route('loans.index') }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if (in_array('dashboard.fdr_requests_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-3 border-bottom-card border-dark">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('FDR Requests') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ request_count('fdr_requests') }}</b></h6>
					</div>
					<div>
						<a href="{{ route('fixed_deposits.index') }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if (in_array('dashboard.wire_transfer_widget',$permissions))
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 border-bottom-card border-primary">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5>{{ _lang('Wire Transfer Requests') }}</h5>
						<h6 class="pt-1 mb-0"><b>{{ request_count('wire_transfer_requests') }}</b></h6>
					</div>
					<div>
						<a href="{{ route('transfer_requests.index') }}"><i class="fa-solid fa-arrow-right"></i>{{ _lang('View') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>


@if (in_array('dashboard.recent_transaction_widget',$permissions))
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header">
				{{ _lang('Recent Transactions') }}
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>{{ _lang('Date') }}</th>
								<th>{{ _lang('Currency') }}</th>
								<th>{{ _lang('Amount') }}</th>
								<th>{{ _lang('Charge') }}</th>
								<th>{{ _lang('Grand Total') }}</th>
								<th>{{ _lang('DR/CR') }}</th>
								<th>{{ _lang('Type') }}</th>
								<th>{{ _lang('Method') }}</th>
								<th>{{ _lang('Status') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($recent_transactions as $transaction)
								@php
								$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
								$class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
								@endphp
								<tr>
									<td>{{ $transaction->created_at }}</td>
									<td>{{ $transaction->currency->name }}</td>
									@if($transaction->dr_cr == 'dr')
									<td>{{ decimalPlace(($transaction->amount - $transaction->fee), currency($transaction->currency->name)) }}</td>
									@else
									<td>{{ decimalPlace(($transaction->amount + $transaction->fee), currency($transaction->currency->name)) }}</td>
									@endif
									<td>{{ $transaction->dr_cr == 'dr' ? '+ '.decimalPlace($transaction->fee, currency($transaction->currency->name)) : '- '.decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td>
									<td><span class="{{ $class }}">{{ $symbol.' '.decimalPlace($transaction->amount, currency($transaction->currency->name)) }}</span></td>
									<td>{{ strtoupper($transaction->dr_cr) }}</td>
									<td>{{ str_replace('_',' ',$transaction->type) }}</td>
									<td>{{ $transaction->method }}</td>
									<td>{!! xss_clean(transaction_status($transaction->status)) !!}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection
