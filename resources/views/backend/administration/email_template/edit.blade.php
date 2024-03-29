@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h4 class="header-title">{{ _lang('Update Email Template') }}</h4>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ action('EmailTemplateController@update', $id) }}" enctype="multipart/form-data">
					@csrf
					<input name="_method" type="hidden" value="PATCH">

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Name') }}</label>
							<input type="text" class="form-control" name="name" value="{{ $emailtemplate->name }}" readOnly="true">
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Short Code') }}</label>
							<pre class="border py-2 px-2">{{ $emailtemplate->shortcode }}</pre>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Subject') }}</label>
							<input type="text" class="form-control" name="subject" value="{{ $emailtemplate->subject }}" required>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Body') }}</label>
							<textarea class="form-control summernote" name="email_body">{{ $emailtemplate->email_body }}</textarea>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Status') }}</label>
							<select class="form-control auto-select" name="email_status" data-selected="{{ $emailtemplate->email_status }}" required>
								<option value="1">{{ _lang('Active') }}</option>
								<option value="0">{{ _lang('Deactive') }}</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> {{ _lang('Update') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection


