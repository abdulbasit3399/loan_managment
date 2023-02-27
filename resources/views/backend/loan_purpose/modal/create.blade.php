<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ route('loan_purpose.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row px-2">
	    <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			</div>
		</div>

		<div class="col-md-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-circle-check"></i> {{ _lang('Save') }}</button>
		    </div>
		</div>
	</div>
</form>
