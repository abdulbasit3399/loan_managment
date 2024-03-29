<div class="sb-sidenav-menu-heading">{{ _lang('NAVIGATIONS') }}</div>

<a class="nav-link" href="{{ route('dashboard.index') }}">
	<div class="sb-nav-link-icon"><i class="fa-regular fa-window-maximize"></i></div>
	{{ _lang('Dashboard') }}
</a>

{{--
<a class="nav-link" href="{{ route('transfer.send_money') }}">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-location-arrow"></i></div>
	{{ _lang('Send Money') }}
</a>
--}}

{{--
<a class="nav-link" href="{{ route('transfer.exchange_money') }}">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
	{{ _lang('Exchange Money') }}
</a>
--}}

{{--
<a class="nav-link" href="{{ route('transfer.wire_transfer') }}">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-building-columns-transfer"></i></div>
	{{ _lang('Wire Transfer') }}
</a>
--}}

{{--
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment_request" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-credit-card"></i></div>
	{{ _lang('Payment Request') }}
	<div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-chevron-down"></i></div>
</a>
<div class="collapse" id="payment_request" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('payment_requests.create') }}">{{ _lang('New Request') }}</a>
		<a class="nav-link" href="{{ route('payment_requests.index') }}">{{ _lang('All Requests') }}</a>
	</nav>
</div>
--}}

{{--
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#deposit" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>
	{{ _lang('Deposit Money') }}
	<div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-chevron-down"></i></div>
</a>
<div class="collapse" id="deposit" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('deposit.automatic_methods') }}">{{ _lang('Automatic Deposit') }}</a>
		<a class="nav-link" href="{{ route('deposit.manual_methods') }}">{{ _lang('Manual Deposit') }}</a>
		<a class="nav-link" href="{{ route('deposit.redeem_gift_card') }}">{{ _lang('Redeem Gift Card') }}</a>
	</nav>
</div>
--}}

{{--
<a class="nav-link" href="{{ route('withdraw.manual_methods') }}">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-circle-minus"></i></div>
	{{ _lang('Withdraw Money') }}
</a>
--}}

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loans" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-dollar-sign"></i></div>
	{{ _lang('Loans') }}
	<div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-chevron-down"></i></div>
</a>
<div class="collapse" id="loans" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('loans.apply_loan') }}">{{ _lang('Apply New Loan') }}</a>
		<a class="nav-link" href="{{ route('loans.my_loans') }}">{{ _lang('My Loans') }}</a>
		<a class="nav-link" href="{{ route('loans.calculator') }}">{{ _lang('Loan Calculator') }}</a>
	</nav>
</div>

{{--
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fdr" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-sack-dollar"></i></div>
	{{ _lang('Fixed Deposit') }}
	<div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-chevron-down"></i></div>
</a>
<div class="collapse" id="fdr" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('fixed_deposits.apply') }}">{{ _lang('Apply New FRD') }}</a>
		<a class="nav-link" href="{{ route('fixed_deposits.history') }}">{{ _lang('FDR History') }}</a>
	</nav>
</div>
--}}

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-headset"></i></div>
	{{ _lang('Support Tickets') }}
	<div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-chevron-down"></i></div>
</a>
<div class="collapse" id="tickets" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('tickets.create_ticket') }}">{{ _lang('Create New Ticket') }}</a>
		<a class="nav-link" href="{{ route('tickets.my_tickets',['status' => 'pending']) }}">{{ _lang('Pending Tickets') }}</a>
		<a class="nav-link" href="{{ route('tickets.my_tickets',['status' => 'active']) }}">{{ _lang('Active Tickets') }}</a>
		<a class="nav-link" href="{{ route('tickets.my_tickets',['status' => 'closed']) }}">{{ _lang('Closed Tickets') }}</a>
	</nav>
</div>

<a class="nav-link" href="{{ route('customer_reports.transactions_report') }}">
	<div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line-up"></i></div>
	{{ _lang('Transactions Report') }}
</a>
