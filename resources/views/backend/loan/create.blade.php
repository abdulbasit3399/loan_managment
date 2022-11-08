@extends('layouts.app')

@section('content')
@php $settings = \App\Models\Setting::all(); @endphp
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Add New Loan') }}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('loans.store') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Loan ID') }}</label>
								<input type="text" class="form-control" name="loan_id" value="{{ ($lastLoan)?$lastLoan->loan_id + 1:get_setting($settings, 'loan_id') +1  }}" readonly required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Loan Product') }}</label>
								<select class="form-control auto-select select2" data-selected="{{ old('loan_product_id') }}" id="loan_product" name="loan_product_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('loan_products','id','name',old('loan_product_id'), array('status=' => 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Borrower') }}</label>
								<select class="form-control auto-select select2" data-selected="{{ old('borrower_id') }}" name="borrower_id" id="borrower_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									@foreach(get_table('users',array('user_type='=>'customer')) as $user )
										<option value="{{ $user->id }}">{{ $user->email .' ('. $user->first_name .' '. $user->last_name . ')' }}</option>
									@endforeach
								</select>
							</div>
						</div>

						{{-- <div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Currency') }}</label>
								<select class="form-control auto-select" data-selected="{{ old('currency_id') }}" name="currency_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('currency','id','name','',array('status=' => 1)) }}
								</select>
							</div>
						</div> --}}
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Loan Purpose') }}</label>
								<select class="form-control auto-select" data-selected="{{ old('loan_purpose_id') }}" name="loan_purpose_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('loan_purposes','id','name') }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('First Payment Date') }}</label>
								<input type="text" class="form-control datepicker" name="first_payment_date" value="{{ old('first_payment_date') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Release Date') }}</label>
								<input type="text" class="form-control datepicker" name="release_date" value="{{ old('release_date') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Applied Amount') }}</label>
								<input type="text" class="form-control float-field" name="applied_amount" value="{{ old('applied_amount') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Late Payment Penalties') }}</label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="late_payment_penalties" id="late_payment_penalties" value="{{ old('late_payment_penalties') }}" readonly required>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Interest Rate %* (per month) ') }}</label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="interest_rate" id="interest_rate" value="{{ old('interest_rate') }}" readonly required>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Interest Type') }}</label>
								<div class="input-group">
									<select class="form-control auto-select"  name="interest_type" id="interest_type" disabled>
										<option value="fixed_rate">{{ _lang('Fixed Rate') }}</option>
										<option value="diminishing_rate">{{ _lang('Diminishing Rate') }}</option>
										{{-- <option value="flat_rate">{{ _lang('Flat Rate') }}</option>
										<option value="mortgage">{{ _lang('Mortgage amortization') }}</option>
										<option value="one_time">{{ _lang('One-time payment') }}</option> --}}
									</select>

								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Term') }}</label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="term" id="term" value="{{ old('term') }}" readonly required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Term Period') }}</label>
								<div class="input-group">
									<select class="form-control auto-select" name="term_period" id="term_period" disabled>
										<option value="">{{ _lang('Select One') }}</option>
										<option value="+1 day">{{ _lang('Day') }}</option>
										<option value="+1 week">{{ _lang('Week') }}</option>
										<option value="+1 month">{{ _lang('Month') }}</option>
										<option value="+1 year">{{ _lang('Year') }}</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Attachment') }}</label>
								<input type="file" class="dropify" name="attachment" value="{{ old('attachment') }}">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Description') }}</label>
								<textarea class="form-control" name="description">{{ old('description') }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Remarks') }}</label>
								<textarea class="form-control" name="remarks">{{ old('remarks') }}</textarea>
							</div>
						</div>

						<div class="col-md-12 end_div mb-2" style="display:none;">
							<div class="checkbox">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="endoresment_required" value="1" id="endoresment_required">
									<label class="custom-control-label" for="endoresment_required">{{ _lang('Endorsement Letter Required?') }}</label>
								</div>
							</div> 
						</div>



						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Changes') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('custom-js')
<script>
	$('#borrower_id').change(function(){
		var user_id = $(this).val();

		var url = "{{ route('get.user_detail',':id'); }}";
		url = url.replace(':id', user_id);
		$.ajax({url: url, success: function(result){
			if(result.data != 0)
				$('.end_div').show();
			else
				$('.end_div').hide();
		}});

	});
	$('#loan_product').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		var valueSelected = this.value;
		var url = "{{ route('get.palenties',':id'); }}";
		url = url.replace(':id', valueSelected);
		$.ajax({url: url, success: function(result){
			$('#late_payment_penalties').val(result.data.penalties);
			$('#interest_rate').val(result.data.interest_rate);
			$('#interest_type option[value='+result.data.interest_type+']').prop('selected', 'selected').change();
			$('#term').val(result.data.term);
			$('#term_period option[value="'+result.data.term_period+'"]').prop('selected', 'selected').change();
		}});
	});
</script>
@endpush