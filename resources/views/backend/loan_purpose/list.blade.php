@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header">
				<span class="panel-title">{{ _lang('Loan Purpose') }}</span>
				<a class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add New Loan Purpose') }}" href="{{ route('loan_purpose.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
			</div>
			<div class="card-body">
				<table id="loan_purpose_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th>{{ _lang('Name') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					    @foreach($loanPurposes as $loanPurpose)
					    <tr data-id="row_{{ $loanPurpose->id }}">
							<td class='name'>{{ $loanPurpose->name }}</td>

							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  {{ _lang('Action') }}
								  </button>
								  <form action="{{ action('LoanPurposeController@destroy', $loanPurpose['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ action('LoanPurposeController@edit', $loanPurpose['id']) }}" data-title="{{ _lang('Update Loan Purpose Details') }}" class="dropdown-item dropdown-edit ajax-modal"><i class="icofont-ui-edit"></i> {{ _lang('Edit') }}</a>
										<a href="{{ action('LoanPurposeController@show', $loanPurpose['id']) }}" data-title="{{ _lang('Loan Purpose Details') }}" class="dropdown-item dropdown-view ajax-modal"><i class="icofont-eye-alt"></i> {{ _lang('View') }}</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> {{ _lang('Delete') }}</button>
									</div>
								  </form>
								</span>
							</td>
					    </tr>
					    @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection