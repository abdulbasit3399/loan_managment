@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Bank Revenues') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('reports.bank_revenues') }}">
						<div class="row">
              				{{ csrf_field() }}

							<div class="col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Year') }}</label>
									<select class="form-control auto-select" name="year" data-selected="{{ isset($year) ? $year : date('Y') }}" required>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Currency') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($currency_id) ? $currency_id : base_currency_id() }}" name="currency_id" required>
										{{ create_option('currency','id','name','',array('status=' => 1)) }}
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="fa-solid fa-filter"></i> {{ _lang('Filter') }}</button>
							</div>
						</form>

					</div>
				</div><!--End Report param-->

				<div class="report-header">
				   <h4>{{ _lang('Bank Revenues') }} {{ isset($year) ? _lang('of').' '.$year : '' }}</h4>
				</div>

				<table class="table table-bordered report-table">
					<thead>
						<th>{{ _lang('Revenue Type') }}</th>
						<th class="text-right">{{ _lang('Amount') }}</th>
					</thead>
					<tbody>
					@if(isset($report_data))

						@php $currency = currency(get_currency($currency_id)->name); @endphp
						@php $total = 0; @endphp

						@foreach($report_data as $revenue)
							<tr>
								<td>{{ str_replace('_', ' ', $revenue->type) }}</td>
								<td class="text-right">{{ decimalPlace($revenue->amount, $currency) }}</td>
							</tr>
							@php $total += $revenue->amount; @endphp
						@endforeach
							<tr>
								<td><b>{{ _lang('Total Revenue') }}</b></td>
								<td class="text-right"><b>{{ decimalPlace($total, $currency) }}</b></td>
							</tr>
					@endif
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection