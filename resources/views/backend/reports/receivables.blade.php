@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Receivables') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('reports.receivables') }}">
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
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="fa-solid fa-filter"></i> {{ _lang('Search') }}</button>
							</div>
						</div>
					</form>

				</div>


				@php $date_format = get_option('date_format','Y-m-d'); @endphp
				@php $currency = currency(); @endphp

				<div class="report-header">
					<h4>{{ _lang('Receivables') }}</h4>
					
				</div>

				<table class="table table-bordered report-table">
					<thead>
						<th>{{ _lang('Loan ID') }}</th>
						<th>{{ _lang('First Name') }}</th>
						<th>{{ _lang('Last Name') }}</th>
						<th>Amount</th>
						<th>{{ _lang('Date Due') }}</th>
						<th>{{ _lang('Total Outstanding Loan') }}</th>
						<th>{{ _lang('No. Days Past Due Date') }}</th>
					</thead>
					<tbody>
						@php
						$total_due = 0;
						if(isset($report_data)):
							foreach($report_data as $transaction):
								$total_due += $transaction->amount_to_pay + $transaction->penalty;
								$date1 = new DateTime($transaction->repayment_date);
								$date2 = new DateTime(date('Y-m-d'));
								$diff = $date1->diff($date2);

								@endphp
								<tr>
									<td>{{$transaction->l_loan_id}}</td>
									<td>
										{{$transaction->name != '' ? $transaction->name : $transaction->first_name }}
									</td>
									<td>
										{{$transaction->name != '' ? $transaction->name : $transaction->last_name }}
									</td>
									<td>{{$transaction->amount_to_pay + $transaction->penalty}}</td>
									<td>{{$transaction->repayment_date}}</td>
									<td>{{$transaction->total_payable - $transaction->total_paid}}</td>
									<td>{{$diff->days.' Days'}}</td>

								</tr>
								@endforeach
								@endif
								<tr>
									<td colspan="2"><b>Account Current Balance</b></td>
									<td></td>
									<td><b>{{$total_due}}</b></td>
									<td></td>
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