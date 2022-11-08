@extends('layouts.app')

@section('content')
<div class="row">
    {{-- <div class="col-md-4 col-lg-3">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#account_overview"><i class="icofont-ui-user"></i> {{ _lang('Account Overview') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transactions"><i class="icofont-listine-dots"></i>{{ _lang('Transactions') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add_money"><i class="icofont-plus-circle"></i> {{ _lang('Add Money') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#deduct_money"><i class="icofont-minus-circle"></i> {{ _lang('Deduct Money') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#my_loans"><i class="icofont-bank"></i> {{ _lang('Loans') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#my_fdr"><i class="icofont-money"></i> {{ _lang('Fixed Deposit') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#support_tickets"><i class="icofont-live-support"></i> {{ _lang('Support Ticket') }}</a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="icofont-email"></i> {{ _lang('Send Email') }}</a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms"><i class="icofont-email"></i> {{ _lang('Send SMS') }}</a></li>
		</ul>
	</div> --}}

    <div class="col-md-8 col-lg-9">
        <div class="tab-content">
			<div id="account_overview" class="tab-pane active">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Company Details') }}</span>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" class="text-center"><img class="thumb-image-sm img-thumbnail"
                                        src="{{ profile_picture($user->profile_picture) }}"></td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Company Name') }}</td>
                                <td>{{ $user->company_name}}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Company Address') }}</td>
                                <td>{{ $user->company_address }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Company Email') }}</td>
                                <td>{{ $user->company_email }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Company Phone') }}</td>
                                <td>{{ '+'.$user->country_code.'-'.$user->company_phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Contact Person First Name') }}</td>
                                <td>{{ $user->first_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Contact Person Middle Name') }}</td>
                                <td>{{ $user->middle_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Contact Person Last Name') }}</td>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Contact Email') }}</td>
                                <td>{{ $user->email != null }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Contact Person Phone') }}</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Contact Info') }}</td>
                                <td>{{ $user->contact_info }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Status') }}</td>
                                <td>{!! xss_clean(status($user->status)) !!}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Email Verified') }}</td>
                                <td>{!! $user->email_verified_at != null ? xss_clean(show_status(_lang('Yes'),'primary')) : xss_clean(show_status(_lang('No'),'danger')) !!}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('SMS Verified') }}</td>
                                <td>{!! $user->sms_verified_at != null ? xss_clean(show_status(_lang('Yes'),'primary')) : xss_clean(show_status(_lang('No'),'danger')) !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!--End account overview Tab-->
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>

</script>
@endsection