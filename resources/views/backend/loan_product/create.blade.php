@extends('layouts.app')



@section('content')

<div class="row">

	<div class="col-lg-12">

		<div class="card">

			<div class="card-header">

				<span class="panel-title">{{ _lang('Add Loan Product') }}</span>

			</div>

			<div class="card-body">

				<form method="post" class="validate" autocomplete="off" action="{{ route('loan_products.store') }}" enctype="multipart/form-data">

					{{ csrf_field() }}

					<div class="row">

						<div class="col-md-12">

							<div class="form-group">

								<label class="control-label">{{ _lang('Product Name') }}</label>

								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Minimum Loanable Amount').' '.currency() }}</label>

								<input type="text" class="form-control float-field" name="minimum_amount" value="{{ old('minimum_amount') }}" required>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Maximum Loanable Amount').' '.currency() }}</label>

								<input type="text" class="form-control float-field" name="maximum_amount" value="{{ old('maximum_amount') }}" required>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Interest Rate %* (per month) ') }}</label>

								<input type="text" class="form-control float-field" name="interest_rate" value="{{ old('interest_rate') }}" required>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Interest Type') }}</label>

								<select class="form-control auto-select" data-selected="{{ old('interest_type','fixed_rate') }}" name="interest_type" required>

									<option value="fixed_rate">{{ _lang('Fixed Rate') }}</option>

									<option value="diminishing_rate">{{ _lang('Diminishing Rate') }}</option>

									{{-- <option value="flat_rate">{{ _lang('Flat Rate') }}</option>

									<option value="mortgage">{{ _lang('Mortgage amortization') }}</option>

									<option value="one_time">{{ _lang('One-time payment') }}</option> --}}

								</select>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Term') }}</label>

								<select class="form-control auto-select" data-selected="{{ old('term',) }}" name="term" required>

									<option value="6">6</option>

									<option value="12">12</option>

									<option value="18">18</option>

									<option value="24">24</option>

									<option value="36">36</option>

									<option value="48">48</option>

									{{-- <option value="fixed_rate">{{ _lang('Fixed Rate') }}</option>

									<option value="mortgage">{{ _lang('Mortgage amortization') }}</option>

									<option value="one_time">{{ _lang('One-time payment') }}</option> --}}

								</select>

								{{-- <input type="number" class="form-control" name="term" value="{{ old('term') }}" required> --}}

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Term Period') }}</label>

								<select class="form-control auto-select" data-selected="{{ old('term_period','+1 month') }}" name="term_period" id="term_period" required>

									{{-- <option value="">{{ _lang('Select One') }}</option>

									<option value="+1 day">{{ _lang('Day') }}</option>

									<option value="+1 week">{{ _lang('Week') }}</option> --}}

									<option value="+1 month">{{ _lang('Month') }}</option>

									{{-- <option value="+1 year">{{ _lang('Year') }}</option> --}}

								</select>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Penalties %* (per month) ') }}</label>

								<input type="text" class="form-control float-field" name="penalties" value="{{ (old('penalties'))?old('penalties'):'5' }}" required>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Down Payment ') }}</label>

								<input type="text" class="form-control float-field" name="down_payment" value="{{ old('down_payment') }}" required>

							</div>

						</div>



						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Loan Status') }}</label>

								<select class="form-control auto-select" data-selected="{{ old('status',1) }}" name="status" required>

									<option value="">{{ _lang('Select One') }}</option>

									<option value="1">{{ _lang('Active') }}</option>

									<option value="0">{{ _lang('Deactivate') }}</option>

								</select>

							</div>

						</div>

						<div class="col-md-6">

							<div class="form-group">

								<label class="control-label">{{ _lang('Visibility') }}</label>

								<select class="form-control" name="visibility" required>

									<option value="Public">{{ _lang('Public') }}</option>

									<option value="Private">{{ _lang('Private') }}</option>

									<option value="Hidden">{{ _lang('Hidden') }}</option>

								</select>

							</div>

						</div>

						<div class="col-md-12">

							<div class="form-group">

								<label class="control-label">{{ _lang('Description') }}</label>

								<textarea class="form-control" name="description">{{ old('description') }}</textarea>

							</div>

						</div>

						@foreach($transactionFees as $transactionFee)

							<div class="col-md-1">

								<div class="form-group">

									<input type="checkbox" name="transaction_fee[]" value="{{ $transactionFee->id }}"/>

									<label class="control-label">{{ $transactionFee->name }}</label>

								</div>

							</div>

						@endforeach





						<div class="col-md-12">

							<div class="form-group">

								<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Changes') }}</button>

							</div>

						</div>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>

@endsection





