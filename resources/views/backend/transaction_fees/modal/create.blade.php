<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ route('transaction_fees.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row px-2">
	    <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			</div>
		</div>
	    <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Transaction Type') }}</label>
				<select class="form-control auto-select" data-selected="{{ old('type','fixed') }}" name="type" id="type" required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="fixed">{{ _lang('Fixed') }}</option>
					<option value="percentage">{{ _lang('Percentage') }}</option>
				</select>
			</div>
		</div>
	    <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount') }}</label>
				<input type="text" class="form-control" name="amount" value="{{ old('amount') }}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount From') }}</label>
				<input type="number" min="0" class="form-control" name="amount_from" value="{{ old('amount_from') }}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount To') }}</label>
				<input type="number" min="0" class="form-control" name="amount_to" value="{{ old('amount_to') }}" required>
			</div>
		</div>
		<div class="col-md-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-circle-check"></i> {{ _lang('Save') }}</button>
		    </div>
		</div>
	</div>
</form>
