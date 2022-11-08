@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Income On Interest') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('income_on_interest') }}">
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
									<select class="form-control auto-select" id="company_id_1" data-selected="{{ isset($company_id) ? $company_id : 'all' }}" name="company_id" required>
										<option value="all">All</option>
										@foreach($company as $com)
										<option value="{{$com->id}}">{{$com->company_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
   
							<div class="col-md-3">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="icofont-filter"></i> {{ _lang('Search') }}</button>
							</div>
						</div>
						</form>
						


					</div>


				@php $date_format = get_option('date_format','Y-m-d'); @endphp
				@php $currency = currency(); @endphp

				<div class="report-header">
					<h4>{{ _lang('Income on Interest') }}</h4>
					<h5>{{ isset($date1) ? date($date_format, strtotime($date1)).' '._lang('to').' '.date($date_format, strtotime($date2)) : '----------  '._lang('to').'  ----------' }}</h5>
				</div>

				<table class="table table-bordered report-table">
					<thead>
						<th>{{ _lang('Loan ID') }}</th>
						<th>{{ _lang('Date') }}</th>
						<th>{{ _lang('Borrower') }}</th>
						<th>{{ _lang('Principal Amount') }}</th>
						<th>{{ _lang('Interest') }}</th>
						<th>{{ _lang('Total Amount') }}</th>
					</thead>
					<tbody>
						@php
						$total_due = 0;
						if(isset($report_data)):
						foreach($report_data as $transaction):
							$total_due += $transaction->interest;
						@endphp
						<tr>
							<td>{{$transaction->l_loan_id}}</td>
							<td>{{$transaction->repayment_date}}</td>
							<td>
								{{$transaction->name != '' ? $transaction->name : $transaction->first_name.' '.$transaction->last_name }}
							</td>
							<td>{{decimalPlace($transaction->principal_amount, currency('PHP'))}}</td>
							<td>{{decimalPlace($transaction->interest, currency('PHP'))}}</td>
							<td>{{decimalPlace($transaction->amount_to_pay, currency('PHP'))}}</td>

						</tr>
						@endforeach
						@endif
						<tr>
							<td style="border-right: none;"><b>Total</b></td>
							<td></td>
							<td></td>
							<td></td>
							<td><b>{{decimalPlace($total_due, currency('PHP')) }}</b></td>
							<td></td>
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