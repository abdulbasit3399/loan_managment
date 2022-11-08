@php $permissions = permission_list(); @endphp
<div class="sb-sidenav-menu-heading">{{ _lang('NAVIGATIONS') }}</div>

<a class="nav-link" href="{{ route('dashboard.index') }}">
	<div class="sb-nav-link-icon"><i class="icofont-dashboard-web"></i></div>
	{{ _lang('Dashboard') }}
</a>



<a class="nav-link" href="{{ route('endorement_request') }}">
	<div class="sb-nav-link-icon"><i class="icofont-bank-transfer-alt"></i></div>
	{{ _lang('Endorsement Request') }}
</a>


