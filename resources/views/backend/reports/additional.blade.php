@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Additional Report') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('reports.additional') }}">
						<div class="row">
							{{ csrf_field() }}

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Age From') }}</label>
									<input type="number" min="1" class="form-control" name="age_from" id="age_from" value="{{ isset($age_from) ? $age_from : old('age_from') }}" required>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Age To') }}</label>
									<input type="number" min="1" class="form-control" name="age_to" id="age_to" value="{{ isset($age_to) ? $age_to : old('age_to') }}" required>
								</div>
							</div>
							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Income From') }}</label>
									<input type="number" min="0" class="form-control" name="income_from" id="income_from" value="{{ isset($income_from) ? $income_from : old('income_from') }}">
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Income To') }}</label>
									<input type="number" min="0" class="form-control" name="income_to" id="income_to" value="{{ isset($income_to) ? $income_to : old('income_to') }}">
								</div>
							</div>
							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Gender') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($gender) ? $gender : old('gender') }}" name="gender">
										<option value="">{{ _lang('All') }}</option>
										<option value="female">{{ _lang('Female') }}</option>
										<option value="male">{{ _lang('Male') }}</option>
									</select>
								</div>
							</div>
							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Martial Status') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($marital_status) ? $marital_status : old('marital_status') }}" name="marital_status">
										<option value="">{{ _lang('All') }}</option>
										<option value="single">Single</option>
										<option value="married">Married</option>
										<option value="widowed">Widowed</option>
										<option value="seperated">Seperated</option>
									</select>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Barangay') }}</label>
									<input type="text"  class="form-control" name="barangay" id="barangay" value="{{ isset($barangay) ? $barangay : old('barangay') }}">
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('City') }}</label>
									<input type="text" class="form-control" name="city" id="city" value="{{ isset($city) ? $city : old('city') }}">
								</div>
							</div>
							
							<div class="col-xl-2 col-lg-4">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="fa-solid fa-filter"></i> {{ _lang('Filter') }}</button>
							</div>
						</form>

					</div>
				</div><!--End Report param-->

				@php $date_format = get_option('date_format','Y-m-d'); @endphp
				@php $currency = currency(); @endphp

				<div class="report-header">
					<h4>{{ _lang('Transactions Report') }}</h4>
					<h5>{{ isset($date1) ? date($date_format, strtotime($date1)).' '._lang('to').' '.date($date_format, strtotime($date2)) : '----------  '._lang('to').'  ----------' }}</h5>
				</div>

				<table class="table table-bordered report-table">
					<thead>
						<th>{{ _lang('Date') }}</th>
						<th>{{ _lang('User') }}</th>
						<th>{{ _lang('AC Number') }}</th>
						<th>{{ _lang('Currency') }}</th>
						<th>{{ _lang('Amount') }}</th>
						<th>{{ _lang('Charge') }}</th>
						<th>{{ _lang('Grand Total') }}</th>
						<th>{{ _lang('DR/CR') }}</th>
						<th>{{ _lang('Type') }}</th>
						<th>{{ _lang('Status') }}</th>
						<th class="text-center">{{ _lang('Details') }}</th>
					</thead>
					<tbody>
						@if(isset($report_data))
						@foreach($report_data as $transaction)
						@php
						$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
						$class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
						@endphp
						<tr>
							<td>{{ $transaction->created_at }}</td>
							<td>
								{{ $transaction->borrower->first_name }} {{ $transaction->borrower->middle_name }} {{ $transaction->borrower->last_name }}</br>
								{{ $transaction->borrower->email }}</br>
							</td>
							<td>{{ $transaction->borrower->account_number }}</td>
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
							<td>{!! xss_clean(transaction_status($transaction->status)) !!}</td>
							<td class="text-center"><a href="{{ action('TransferRequestController@show', $transaction->id) }}" data-title="{{ _lang('Transaction Details') }}" class="btn btn-outline-primary btn-sm ajax-modal">{{ _lang('View') }}</a></td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection