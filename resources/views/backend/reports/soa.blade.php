@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Statement of Account') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('reports.soa') }}">
						<div class="row">
							{{ csrf_field() }}
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('Start Date') }}</label>
									<input type="text" class="form-control datepicker" name="date1" id="date1_1" value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('End Date') }}</label>
									<input type="text" class="form-control datepicker" name="date2" id="date2_1" value="{{ isset($date2) ? $date2 : old('date2') }}" readOnly="true" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">{{ _lang('Company') }}</label>
									<select class="form-control auto-select" id="company_id_1" data-selected="{{ isset($company_id) ? $company_id : old('company_id') }}" name="company_id" required>
										<option value="">Select Company</option>
										@foreach($company as $com)
										<option value="{{$com->id}}">{{$com->company_name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="icofont-filter"></i> {{ _lang('Company Search') }}</button>
							</div>
						</div>
					</form>


					<form class="validate" id="save_pdf_form" method="post" action="{{ route('reports.save_pdf') }}">
						<div class="row">
							<input type="hidden" name="date1" id="date1_2" value="">
							<input type="hidden" name="date2" id="date2_2" value="">
							<input type="hidden" name="company_id" id="company_id_2" value="">
							{{ csrf_field() }}
							<div class="col-md-3">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="icofont-filter"></i> {{ _lang('Save Report') }}</button>
							</div>
						</div>
					</form>
				</div>


				@php $date_format = get_option('date_format','Y-m-d'); @endphp
				@php $currency = currency(); @endphp

				<div class="report-header">
					<h4>{{ _lang('Statement') }}</h4>
					@if(isset($report_data))
					<div class="row">
						<div class="col-md-6 text-left">
							<p><b>Client: &nbsp;</b>{{ucfirst($user_company->company_name)}}</p>
							<p><b>Contact Person:&nbsp;</b>{{ucfirst($user_company->first_name.' '.$user_company->last_name)}}</p>
						</div>
						<div class="col-md-6 text-right">
							<p><b>Statement #:&nbsp;</b>{{date('y').'-'.str_pad($statement->id+1, 4, '0', STR_PAD_LEFT)}}</p>
							<p><b>Date:&nbsp;</b>{{date('Y-m-d')}}</p>
						</div>
					</div>

					@endif
				</div>

				<table class="table table-bordered report-table">
					<thead>
						<th>{{ _lang('Loan ID') }}</th>
						<th>{{ _lang('Date') }}</th>
						<th>{{ _lang('Borrower') }}</th>
						<th>{{ _lang('Penalty') }}</th>
						<th>{{ _lang('Amount to Pay') }}</th>
						<th>{{ _lang('Amount Due') }}</th>
						<th>{{ _lang('Action') }}</th>
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
									<td>
										<a href="{{route('loans.change_loan_repayments',[$transaction->id,1])}}" class="btn btn-success">Pay</a>
									</td>
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
					</div>
				</div>
			</div>
		</div>

		@endsection

		@section('js-script')
		<script type="text/javascript">
			$('#company_id_1').change(function(){

			});
			$('#save_pdf_form').submit(function(e){
				e.preventDefault();
				$('#date1_2').val($('#date1_1').val());
				$('#date2_2').val($('#date2_1').val());
				$('#company_id_2').val($('#company_id_1').find(":selected").val());
				$.ajax({
					url: '{{route("reports.save_pdf")}}',
					method: "POST",
					processData: false, 
					contentType: false,
					data: new FormData(this),
					success: function(res){
						if(res == true)
							alert('Report saved successfully.')
					}

				});
			});
		</script>

		@endsection