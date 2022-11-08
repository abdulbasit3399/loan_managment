@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Statement') }}</span>
			</div>

			<div class="card-body">

				<table class="table table-bordered">
					<thead>
						<th>{{ _lang('Statement #') }}</th>
						<th>{{ _lang('Date') }}</th>
						<th>{{ _lang('Company') }}</th>
						<th>{{ _lang('Report') }}</th>
					</thead>
					<tbody>
						@foreach($reports as $report)
						@if($report->company)
						<tr>
							<td>{{ $report->statement_id }}</td>
							<td>{{ $report->date }}</td>
							<td>{{ $report->company->company_name }}</td>
							<td><a download="{{$report->report}}" href="{{asset('uploads/pdf/'.$report->report)}}">Download Report</a></td>

						</tr>
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')

@endsection