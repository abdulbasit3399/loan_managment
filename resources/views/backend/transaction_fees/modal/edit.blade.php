<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ action('TransactionFeeController@update', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>
				<input type="text" class="form-control" name="name" value="{{ $transactionFee->name }}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Transaction Type') }}</label>
				<select class="form-control auto-select" data-selected="{{ $transactionFee->type }}" name="type" required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="fixed">{{ _lang('Fixed') }}</option>
					<option value="percentage">{{ _lang('Percentage') }}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount') }}</label>
				<input type="text" class="form-control" name="amount" value="{{ $transactionFee->amount }}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount From') }}</label>
				<input type="number" class="form-control" name="amount_from" value="{{ $transactionFee->amount_from }}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount To') }}</label>
				<input type="number" class="form-control" name="amount_to" value="{{ $transactionFee->amount_to }}" required>
			</div>
		</div>


		<div class="col-md-12 mt-2">
			<div class="form-group">
			    <button type="submit" class="btn btn-primary btn-lg"><i class="icofont-check-circled"></i> {{ _lang('Update') }}</button>
		    </div>
		</div>
	</div>
</form>

