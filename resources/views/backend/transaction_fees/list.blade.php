@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header">
				<span class="panel-title">{{ _lang('Transaction Fees') }}</span>
				<a class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add New Transaction Fee') }}" href="{{ route('transaction_fees.create') }}"><i class="fa-solid fa-circle-plus"></i> {{ _lang('Add New') }}</a>
			</div>
			<div class="card-body">
				<table id="transaction_fees_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th>{{ _lang('Name') }}</th>
						    <th>{{ _lang('Type') }}</th>
						    <th>{{ _lang('Fee Amount') }}</th>
						    <th>{{ _lang('Amount From') }}</th>
						    <th>{{ _lang('Amount To') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					    @foreach($transactionFees as $transactionFee)
					    <tr data-id="row_{{ $transactionFee->id }}">
							<td class='name'>{{ $transactionFee->name }}</td>
							<td class='name'>{{ $transactionFee->type }}</td>
							<td class='name'>{{ $transactionFee->amount }}</td>
							<td class='name'>{{ $transactionFee->amount_from }}</td>
							<td class='name'>{{ $transactionFee->amount_to }}</td>

							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  {{ _lang('Action') }}
								  </button>
								  <form action="{{ action('TransactionFeeController@destroy', $transactionFee['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ action('TransactionFeeController@edit', $transactionFee['id']) }}" data-title="{{ _lang('Update Loan Purpose Details') }}" class="dropdown-item dropdown-edit ajax-modal"><i class="fa-solid fa-pen-to-square"></i> {{ _lang('Edit') }}</a>
										{{-- <a href="{{ action('TransactionFeeController@show', $transactionFee['id']) }}" data-title="{{ _lang('Loan Purpose Details') }}" class="dropdown-item dropdown-view ajax-modal"><i class="fa-solid fa-eye"></i> {{ _lang('View') }}</a> --}}
										<button class="btn-remove dropdown-item" type="submit"><i class="fa-solid fa-trash"></i> {{ _lang('Delete') }}</button>
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