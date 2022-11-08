<table class="table table-bordered">
	<tr><td>{{ _lang('User First Name') }}</td><td>{{ $transaction->user->first_name }}</td></tr>
	<tr><td>{{ _lang('User Middle Name') }}</td><td>{{ $transaction->user->middle_name }}</td></tr>
	<tr><td>{{ _lang('User Last Name') }}</td><td>{{ $transaction->user->last_name }}</td></tr>
	<tr><td>{{ _lang('Account Number') }}</td><td>{{ $transaction->account_number }}</td></tr>
	<tr><td>{{ _lang('User Email') }}</td><td>{{ $transaction->user->email }}</td></tr>
	<tr><td>{{ _lang('Amount') }}</td><td>{{ decimalPlace($transaction->amount,currency($transaction->currency->name)) }}</td></tr>
	<tr><td>{{ _lang('DR/CR') }}</td><td>{{ strtoupper($transaction->dr_cr) }}</td></tr>
	<tr><td>{{ _lang('Type') }}</td><td>{{ $transaction->type }}</td></tr>
	<tr><td>{{ _lang('Method') }}</td><td>{{ $transaction->method }}</td></tr>
	<tr><td>{{ _lang('Status') }}</td><td>{!! xss_clean(transaction_status($transaction->status)) !!}</td></tr>
	<tr><td>{{ _lang('Note') }}</td><td>{{ $transaction->note }}</td></tr>
	<tr><td>{{ _lang('Created By') }}</td><td>{{ $transaction->created_by->name}}</td></tr>
</table>

