@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title">{{ _lang('Withdraw History') }}</span>
				<a class="btn btn-primary btn-sm ml-auto" href="{{ route('deposits.create') }}"><i class="fa-solid fa-circle-plus"></i> {{ _lang('Add New') }}</a>
			</div>
			<div class="card-body">
				<table id="deposits_table" class="table table-bordered">
					<thead>
					    <tr>
							<th>{{ _lang('User') }}</th>
						    <th>{{ _lang('AC Number') }}</th>
							<th>{{ _lang('Amount') }}</th>
							<th>{{ _lang('Type') }}</th>
							<th>{{ _lang('Method') }}</th>
							<th>{{ _lang('Status') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')
<script src="{{ asset('backend/assets/js/datatables/withdraw.js?v=1.0') }}"></script>
@endsection