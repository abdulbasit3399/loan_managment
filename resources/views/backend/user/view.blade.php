@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-4 col-lg-3">
    <ul class="nav flex-column nav-tabs settings-tab" role="tablist">
      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#account_overview"><i class="fa-solid fa-user"></i> {{ _lang('Account Overview') }}</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transactions"><i class="fa-solid fa-list"></i>{{ _lang('Transactions') }}</a></li>
      {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add_money"><i class="fa-solid fa-circle-plus"></i> {{ _lang('Add Money') }}</a></li> --}}
      {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#deduct_money"><i class="fa-solid fa-circle-minus"></i> {{ _lang('Deduct Money') }}</a></li> --}}
      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#my_loans"><i class="fa-solid fa-building-columns"></i> {{ _lang('Loans') }}</a></li>
      {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#my_fdr"><i class="fa-solid fa-sack-dollar"></i> {{ _lang('Fixed Deposit') }}</a></li> --}}
      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#support_tickets"><i class="fa-solid fa-headset"></i> {{ _lang('Support Ticket') }}</a></li>
      {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="fa-solid fa-envelope"></i> {{ _lang('Send Email') }}</a></li> --}}
      {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms"><i class="fa-solid fa-envelope"></i> {{ _lang('Send SMS') }}</a></li> --}}
    </ul>
  </div>

  <div class="col-md-8 col-lg-9">
    <div class="tab-content">
     <div id="account_overview" class="tab-pane active">
      <div class="card">
        <div class="card-header">
          <span class="header-title">{{ _lang('User Details') }}</span>
        </div>

        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <td colspan="2" class="text-center"><img class="thumb-image-sm img-thumbnail"
                src="{{ profile_picture($user->profile_picture) }}"></td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="row">
                    @foreach($account_balance as $currency)
                    <div class="col-md">
                      <div class="card mb-4">
                        <div class="card-body">
                          <h6>{{ $currency->name.' '._lang('Balance') }}</h6>
                          <h6 class="pt-1"><b>{{ decimalPlace($currency->balance, currency($currency->name)) }}</b></h6>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </td>
              </tr>
              <tr>
                <td>{{ _lang('Company Name') }}</td>
                <td>{{ $comapny }}</td>
              </tr>
              @if($user->company_e_signature != null)
              <tr>
                <td>{{ _lang('Endorsement Letter') }}</td>
                <td>
                  <a href="{{asset('uploads/pdf/'.$user->company_e_signature)}}" class="btn btn-primary btn-sm approve"><i class="fa-sharp fa-solid fa-download"></i> {{ _lang('Download Endorsement Letter') }}</a>
                </td>
              </tr>
              @endif
              <tr>
                <td>{{ _lang('First Name') }}</td>
                <td>{{ $user->first_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Middle Name') }}</td>
                <td>{{ $user->middle_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Last Name') }}</td>
                <td>{{ $user->last_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Account Number') }}</td>
                <td>{{ $user->account_number }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Email') }}</td>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Phone') }}</td>
                <td>{{ '+'.$user->country_code.'-'.$user->phone }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Branch') }}</td>
                <td>{{ $user->branch->name }}</td>
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

              <tr>
                <td>{{ _lang('Home Address') }}</td>
                <td>{{ $user->home_address }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse First Name') }}</td>
                <td>{{ $user->spouse_first_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Middle Name') }}</td>
                <td>{{ $user->spouse_middle_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Last Name') }}</td>
                <td>{{ $user->spouse_last_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Marital Status') }}</td>
                <td>{{ $user->marital_status }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Present Employer Name') }}</td>
                <td>{{ $user->present_employer_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Present Employer Address') }}</td>
                <td>{{ $user->present_employer_address }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Current Position') }}</td>
                <td>{{ $user->present_employer_position }}</td>
              </tr>
              <tr>
                <td>{{ _lang('SBU/ Department') }}</td>
                <td>{{ $user->sbu_department }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Start of Employment') }}</td>
                <td>{{ $user->present_employer_since }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Length of Service (2 Years)') }}</td>
                <td>{{ $user->present_length_service }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Present Employer Phone no') }}</td>
                <td>{{ $user->present_employer_phone }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Previous Employer Name') }}</td>
                <td>{{ $user->previous_employer_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Previous Employer Address') }}</td>
                <td>{{ $user->previous_employer_address }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Previous Position') }}</td>
                <td>{{ $user->previous_employer_position }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Previous Employee Since') }}</td>
                <td>{{ $user->previous_employer_since }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Previous Employer  Phone no') }}</td>
                <td>{{ $user->previous_employer_phone }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Present Employer Name') }}</td>
                <td>{{ $user->spouse_present_employer_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Present Employer Address') }}</td>
                <td>{{ $user->spouse_present_employer_address }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Present Position') }}</td>
                <td>{{ $user->spouse_present_employer_position }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Present Employee Since') }}</td>
                <td>{{ $user->spouse_present_employer_since }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Present Employer Phone no') }}</td>
                <td>{{ $user->spouse_present_employer_phone }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Previous Employer Name') }}</td>
                <td>{{ $user->spouse_previous_employer_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Previous Employer Address') }}</td>
                <td>{{ $user->spouse_preious_employer_address }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Previous Position') }}</td>
                <td>{{ $user->spouse_previous_employer_position }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Previous Employee Since') }}</td>
                <td>{{ $user->spouse_previous_employer_since }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Spouse Previous Employer  Phone no') }}</td>
                <td>{{ $user->spouse_previous_employer_phone }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Own Salary') }}</td>
                <td>{{ $user->own_salary }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Other Income') }}</td>
                <td>{{ $user->other_income }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Total Income') }}</td>
                <td>{{ $user->total_income }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Fixed Obligation') }}</td>
                <td>{{ $user->fixed_obligations }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Other Living Expense') }}</td>
                <td>{{ $user->other_living_expense }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Net Monthly Income') }}</td>
                <td>{{ $user->net_monthly_income }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Refference First Name') }}</td>
                <td>{{ $user->refference_first_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Refference Last Name') }}</td>
                <td>{{ $user->refference_last_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Refference Company Name') }}</td>
                <td>{{ $user->refference_company_name }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Refference Position') }}</td>
                <td>{{ $user->refference_position }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Refference Address') }}</td>
                <td>{{ $user->refference_address }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Refference Mobile No') }}</td>
                <td>{{ $user->refference_mobile }}</td>
              </tr>
              <tr>
                <td>{{ _lang('Withdraw Money') }}</td>
                <td>{!! $user->allow_withdrawal == 1 ? xss_clean(show_status(_lang('Allowed'),'primary')) : xss_clean(show_status(_lang('Not Allowed'),'danger')) !!}</td>
              </tr>
              <tr>
                <td>{{ _lang('Account Opening Date') }}</td>
                <td>{{ $user->created_at }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div><!--End account overview Tab-->

      <div id="transactions" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Transactions') }}</span>
          </div>

          <div class="card-body">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>{{ _lang('Date') }}</th>
                  <th>{{ _lang('Currency') }}</th>
                  <th>{{ _lang('Amount') }}</th>
                  <th>{{ _lang('Charge') }}</th>
                  <th>{{ _lang('Grand Total') }}</th>
                  <th>{{ _lang('DR/CR') }}</th>
                  <th>{{ _lang('Type') }}</th>
                  <th>{{ _lang('Status') }}</th>
                  <th>{{ _lang('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->transactions as $transaction)
                @php
                $symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
                $class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
                @endphp
                <tr>
                  <td>{{ $transaction->created_at }}</td>
                  <td>{{ $transaction->currency->name }}</td>
                  @if($transaction->dr_cr == 'dr')
                  <td>{{ decimalPlace(($transaction->amount - $transaction->fee), currency($transaction->currency->name)) }}</td>
                  @else
                  <td>{{ decimalPlace(($transaction->amount + $transaction->fee), currency($transaction->currency->name)) }}</td>
                  @endif
                  <td>{{ $transaction->dr_cr == 'dr' ? '+ '.decimalPlace($transaction->fee, currency($transaction->currency->name)) : '- '.decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td>
                  <td><span class="{{ $class }}">{{ $symbol.' '.decimalPlace($transaction->amount, currency($transaction->currency->name)) }}</span></td>
                  <td>{{ strtoupper($transaction->dr_cr) }}</td>
                  <td>{{ str_replace('_',' ',$transaction->type) }}</td>
                  <td>{!! xss_clean(transaction_status($transaction->status)) !!}</td>
                  <td><a href="{{ action('TransferRequestController@show', $transaction['id']) }}" data-title="{{ _lang('Transaction Details') }}" class="btn btn-outline-primary btn-sm ajax-modal"><i class="fa-solid fa-eye"></i> {{ _lang('Details') }}</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div><!--End Transaction Tab-->

      <div id="add_money" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Add Money') }}</span>
          </div>

          <div class="card-body">
            <form method="post" class="validate" autocomplete="off" action="{{ route('deposits.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('User Email') }}</label>
                    <input type="email" class="form-control" name="account_number" value="{{ $user->email }}" required="" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Currency') }}</label>
                    <select class="form-control auto-select select2" data-selected="{{ old('currency_id') }}" name="currency_id" required>
                      <option value="">{{ _lang('Select One') }}</option>
                      {{ create_option('currency','id','name','',array('status=' => 1)) }}
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Amount') }}</label>
                    <input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Note') }}</label>
                    <textarea class="form-control" name="note">{{ old('note') }}</textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-circle-check"></i> {{ _lang('Submit') }}</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div><!--End Add Money Tab-->

      <div id="deduct_money" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Deduct Money') }}</span>
          </div>

          <div class="card-body">
            <form method="post" class="validate" autocomplete="off" action="{{ route('withdraw.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('User Email') }}</label>
                    <input type="email" class="form-control" name="account_number" value="{{ $user->email }}" required="" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Currency') }}</label>
                    <select class="form-control auto-select select2" data-selected="{{ old('currency_id') }}" name="currency_id" required>
                      <option value="">{{ _lang('Select One') }}</option>
                      {{ create_option('currency','id','name','',array('status=' => 1)) }}
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Amount') }}</label>
                    <input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Note') }}</label>
                    <textarea class="form-control" name="note">{{ old('note') }}</textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-circle-check"></i> {{ _lang('Submit') }}</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div><!--End Add Money Tab-->

      <div id="my_loans" class="tab-pane">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <span class="panel-title">{{ _lang('Loans') }}</span>
            <a class="btn btn-primary btn-sm float-right" href="{{ route('loans.create') }}"><i class="fa-solid fa-circle-plus"></i> {{ _lang('Add New Loan') }}</a>
          </div>

          <div class="card-body">
            <table id="loans_table" class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>{{ _lang('Loan ID') }}</th>
                  <th>{{ _lang('Loan Product') }}</th>
                  <th class="text-right">{{ _lang('Applied Amount') }}</th>
                  <th class="text-right">{{ _lang('Total Payable') }}</th>
                  <th class="text-right">{{ _lang('Amount Paid') }}</th>
                  <th class="text-right">{{ _lang('Due Amount') }}</th>
                  <th>{{ _lang('Release Date') }}</th>
                  <th>{{ _lang('Status') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->loans as $loan)
                <tr>
                  <td><a href="{{ route('loans.show',$loan->id) }}">{{ $loan->loan_id }}</a></td>
                  <td>{{ $loan->loan_product->name }}</td>
                  <td class="text-right">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td>
                  <td class="text-right">{{ decimalPlace($loan->total_payable, currency($loan->currency->name)) }}</td>
                  <td class="text-right">{{ decimalPlace($loan->total_paid, currency($loan->currency->name)) }}</td>
                  <td class="text-right">{{ decimalPlace($loan->total_payable - $loan->total_paid, currency($loan->currency->name)) }}</td>
                  <td>{{ $loan->release_date }}</td>
                  <td>
                    @if($loan->status == 0)
                    {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                    @elseif($loan->status == 1)
                    {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                    @elseif($loan->status == 2)
                    {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                    @elseif($loan->status == 3)
                    {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div><!--End Send Email Tab-->

      <div id="my_fdr" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Fixed Deposit') }}</span>
          </div>

          <div class="card-body">
            <table id="fdr_table" class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>{{ _lang('Plan') }}</th>
                  <th>{{ _lang('Currency') }}</th>
                  <th>{{ _lang('Deposit Amount') }}</th>
                  <th>{{ _lang('Return Amount') }}</th>
                  <th>{{ _lang('Status') }}</th>
                  <th>{{ _lang('Mature Date') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->fixed_deposits as $fixed_deposit)
                <tr>
                  <td>{{ $fixed_deposit->plan->name }}</td>
                  <td>{{ $fixed_deposit->currency->name }}</td>
                  <td>{{ decimalPlace($fixed_deposit->deposit_amount, currency($fixed_deposit->currency->name)) }}</td>
                  <td>{{ decimalPlace($fixed_deposit->return_amount, currency($fixed_deposit->currency->name)) }}</td>
                  <td>{!! xss_clean(fdr_status($fixed_deposit->status)) !!}</td>
                  <td>{{ $fixed_deposit->mature_date }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div><!--End Fixed Deposit Tab-->

      <div id="support_tickets" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Support Tickets') }}</span>
          </div>

          <div class="card-body">
            <table id="support_tickets_table" class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>{{ _lang('ID') }}</th>
                  <th>{{ _lang('Subject') }}</th>
                  <th>{{ _lang('Status') }}</th>
                  <th>{{ _lang('Created') }}</th>
                  <th class="text-center">{{ _lang('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->support_tickets as $supportticket)
                <tr>
                  <td>{{ $supportticket->id }}</td>
                  <td>{{ $supportticket->subject }}</td>
                  <td>{!! xss_clean(ticket_status($supportticket->status)) !!}</td>
                  <td>{{ $supportticket->created_at }}</td>
                  <td class="text-center">
                    <a href="{{ action('SupportTicketController@show', $supportticket['id']) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-message-dots"></i> {{ _lang('View Conversations') }}</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div><!--End Support ticket Tab-->

      <div id="email" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Send Email') }}</span>
          </div>

          <div class="card-body">
            <form method="post" class="validate" autocomplete="off" action="{{ route('users.send_email') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('User Email') }}</label>
                    <input type="email" class="form-control" name="user_email" value="{{ $user->email }}" required="" readonly>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Subject') }}</label>
                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Message') }}</label>
                    <textarea class="form-control" rows="8" name="message" required>{{ old('message') }}</textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-circle-check"></i> {{ _lang('Send') }}</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div><!--End Send Email Tab-->

      <div id="sms" class="tab-pane">
        <div class="card">
          <div class="card-header">
            <span class="header-title">{{ _lang('Send SMS') }}</span>
          </div>

          <div class="card-body">
            <form method="post" class="validate" autocomplete="off" action="{{ route('users.send_sms') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('User Mobile') }}</label>
                    <input type="text" class="form-control" name="phone" value="{{ '+'.$user->country_code.$user->phone }}" required="" readonly>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">{{ _lang('Message') }}</label>
                    <textarea class="form-control" name="message" required>{{ old('message') }}</textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-circle-check"></i> {{ _lang('Send') }}</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div><!--End Send SMS Tab-->

    </div>
  </div>
</div>
@endsection

@section('js-script')
<script>
 (function($) {
   "use strict";

   $('.nav-tabs a').on('shown.bs.tab', function(event){
     var tab = $(event.target).attr("href");
     var url = "{{ route('users.show',$user->id) }}";
     history.pushState({}, null, url + "?tab=" + tab.substring(1));
   });

   @if(isset($_GET['tab']))
   $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
   @endif

   $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });

 })(jQuery);
</script>
@endsection