@extends('layouts.app')

@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <span class="panel-title">{{ _lang("View Loan Details") }}</span>
         </div>
         <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#loan_details">{{
                  _lang("Loan Details")
                  }}</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#collateral">{{
                  _lang("Collateral")
                  }}</a>
               </li>
               @if(count($repayments) > 0)
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#schedule">{{
                  _lang("Repayments Schedule")
                  }}</a>
               </li>
               @endif
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#repayments">{{
                  _lang("Repayments")
                  }}</a>
               </li>
               <li class="nav-item">
                  <a
                     class="nav-link"
                     href="{{ action('LoanController@edit', $loan['id']) }}"
                     >{{ _lang("Edit") }}</a
                     >
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="loan_details">
                  @if($loan->status == 0)
                  <div class="alert alert-warning mt-4">
                     <p>
                        {{ _lang("Add Loan ID, Release Date and First Payment Date before approving loan request") }}
                     </p>
                  </div>
                  @endif
                  <table class="table table-bordered mt-4">
                     <tr>
                        <td>{{ _lang("Loan ID") }}</td>
                        <td>{{ $loan->loan_id }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Borrower") }}</td>
                        <td>{{ $loan->borrower->first_name.' '.$loan->borrower->last_name }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Account") }}</td>
                        <td>{{ $loan->borrower->email }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Status") }}</td>
                        <td>
                           @if($loan->status == 0 && $loan->endoresment_required == 1)
                              {!! xss_clean(show_status(_lang('Endoresment Letter Required'), 'warning')) !!}
                           @else

                            @if($loan->status == 0)
                                {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                            @elseif($loan->status == 1)
                                {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                            @elseif($loan->status == 2)
                                {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                            @elseif($loan->status == 3)
                                {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                            @endif
                           
                           @endif

                           @if($loan->status == 0)
                           <a class="btn btn-outline-primary btn-sm" href="{{ action('LoanController@approve', $loan['id']) }}"><i class="fa-solid fa-circle-check"></i> {{ _lang("Click to Approve") }}</a
                              >
                           <a class="btn btn-outline-danger btn-sm float-right" href="{{ action('LoanController@reject', $loan['id']) }}"><i class="fa-solid fa-circle-xmark"></i> {{ _lang("Click to Reject") }}</a>
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("First Payment Date") }}</td>
                        <td>{{ $loan->first_payment_date }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Release Date") }}</td>
                        <td>
                           {{ $loan->release_date != '' ? $loan->release_date : '' }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Applied Amount") }}</td>
                        <td>
                           {{ decimalPlace($loan->applied_amount, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Total Payable") }}</td>
                        <td>
                           {{ decimalPlace($loan->total_payable, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Total Paid") }}</td>
                        <td class="text-success">
                           {{ decimalPlace($loan->total_paid, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Due Amount") }}</td>
                        <td class="text-danger">
                           {{ decimalPlace($loan->total_payable - $loan->total_paid, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Late Payment Penalties") }}</td>
                        <td>{{ $loan->late_payment_penalties }} %</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Attachment") }}</td>
                        <td>
                           {!! $loan->attachment == "" ? '' : '<a
                              href="'. asset('uploads/media/'.$loan->attachment) .'"
                              target="_blank"
                              >'._lang('Download').'</a
                              >' !!}
                        </td>
                     </tr>
                     @if($loan->status == 1)
                     <tr>
                        <td>{{ _lang("Approved Date") }}</td>
                        <td>{{ $loan->approved_date }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Approved By") }}</td>
                        <td>{{ $loan->approved_by->name }}</td>
                     </tr>
                     @endif
                     <tr>
                        <td>{{ _lang("Description") }}</td>
                        <td>{{ $loan->description }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Remarks") }}</td>
                        <td>{{ $loan->remarks }}</td>
                     </tr>
                  </table>
               </div>
               <div class="tab-pane fade" id="collateral">
                  <div class="card">
                     <div class="card-header d-flex align-items-center">
                        <span>{{ _lang("All Collaterals") }}</span>
                        <a
                           class="btn btn-primary btn-sm ml-auto"
                           href="{{ route('loan_collaterals.create',['loan_id' => $loan->id]) }}"
                           ><i class="fa-solid fa-circle-plus"></i>
                        {{ _lang("Add New Collateral") }}</a
                           >
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-bordered mt-2">
                              <thead>
                                 <tr>
                                    <th>{{ _lang("Name") }}</th>
                                    <th>{{ _lang("Collateral Type") }}</th>
                                    <th>{{ _lang("Serial Number") }}</th>
                                    <th>{{ _lang("Estimated Price") }}</th>
                                    <th class="text-center">{{ _lang("Action") }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($loancollaterals as $loancollateral)
                                 <tr data-id="row_{{ $loancollateral->id }}">
                                    <td class="name">{{ $loancollateral->name }}</td>
                                    <td class="collateral_type">
                                       {{ $loancollateral->collateral_type }}
                                    </td>
                                    <td class="serial_number">
                                       {{ $loancollateral->serial_number }}
                                    </td>
                                    <td class="estimated_price">
                                       {{ decimalPlace($loancollateral->estimated_price, currency($loan->currency->name)) }}
                                    </td>
                                    <td class="text-center">
                                       <div class="dropdown">
                                          <button
                                             class="btn btn-primary dropdown-toggle btn-sm"
                                             type="button"
                                             id="dropdownMenuButton"
                                             data-toggle="dropdown"
                                             aria-haspopup="true"
                                             aria-expanded="false"
                                             >
                                          {{ _lang("Action") }}
                                          </button>
                                          <form
                                             action="{{
                                             action(
                                             'LoanCollateralController@destroy',
                                             $loancollateral['id']
                                             )
                                             }}"
                                             method="post"
                                             >
                                             {{ csrf_field() }}
                                             <input
                                                name="_method"
                                                type="hidden"
                                                value="DELETE"
                                                />
                                             <div
                                                class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton"
                                                >
                                                <a
                                                   href="{{
                                                   action(
                                                   'LoanCollateralController@edit',
                                                   $loancollateral['id']
                                                   )
                                                   }}"
                                                   class="
                                                   dropdown-item dropdown-edit dropdown-edit
                                                   "
                                                   ><i class="fa-solid fa-pen-to-square"></i>
                                                {{ _lang("Edit") }}</a
                                                   >
                                                <a
                                                   href="{{
                                                   action(
                                                   'LoanCollateralController@show',
                                                   $loancollateral['id']
                                                   )
                                                   }}"
                                                   class="
                                                   dropdown-item dropdown-view dropdown-view
                                                   "
                                                   ><i class="fa-solid fa-eye"></i>
                                                {{ _lang("View") }}</a
                                                   >
                                                <button
                                                   class="btn-remove dropdown-item"
                                                   type="submit"
                                                   >
                                                <i class="fa-solid fa-trash"></i>
                                                {{ _lang("Delete") }}
                                                </button>
                                             </div>
                                          </form>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade mt-4" id="repayments">
                  <table class="table table-bordered data-table1">
                     <thead>
                        <tr>
                           <th>{{ _lang("No. of Payments") }}</th>
                           <th>{{ _lang("Date") }}</th>
                           <th class="text-right">{{ _lang("Paid Amount") }}</th>
                           <th class="text-right">{{ _lang("Principal Amount") }}</th>
                           <th class="text-right">{{ _lang("Total Interest") }}</th>
                           {{-- @foreach($transactionFees as $transactionFee)
                              <th class="text-center">{{ $transactionFee->name}}</th>
                           @endforeach --}}
                           <th class="text-right">{{ _lang("Late Penalty") }}</th>
                           <th class="text-right">{{ _lang("Outstanding Balance") }}</th>
                           <th class="text-center">{{ _lang("Status") }}</th>
                           <th class="text-center">{{ _lang("Payment Proof") }}</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody class="text-center">
                        @php $count = 1; @endphp
                        @foreach($payments as $payment)
                        <tr>
                           <td>{{$count}}</td>
                           <td>{{ $payment->paid_at }}</td>
                           <td class="text-right">
                              {{ decimalPlace($payment['amount_to_pay'], currency($loan->currency->name)) }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($payment->loan_repayment->principal_amount, currency($loan->currency->name)) }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($payment['interest'], currency($loan->currency->name)) }}
                           </td>
                          {{--  @foreach($transactionFees as $transactionFee)
                              <td class="text-center">{{ decimalPlace( ( ($payment->loan->loan_product->transactionFee->contains($transactionFee->id) )? ( $transactionFee->amount / $payment->loan->loan_product->term ) : "0"), currency($loan->currency->name)) }}</td>
                           @endforeach --}}
                           <td class="text-right">
                              {{ decimalPlace($payment['penalty'], currency($loan->currency->name)) }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($payment->loan_repayment->balance, currency($loan->currency->name)) }}
                           </td>
                           <td class="text-center">
                              {!! $payment['status'] == 1 ?
                              show_status(_lang('Paid'),'success') :
                              show_status(_lang('Unpaid'),'danger') !!}
                           </td>
                           <td>
                              @if($payment['reciept'])
                              <a href="{{asset('uploads/recipet/'.$payment['reciept'])}}" target="_blank">Attachment</a>
                              @endif
                           </td>
                           
                           <td>
                              @if($payment['status'] == 0)
                              <div class="d-flex">
                                 <a href="{{route('loans.loan_payment_status',[$payment['id'],1])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></a>
                                 <a href="{{route('loans.loan_payment_status',[$payment['id'],2])}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></a>
                              </div>
                              @else
                                 <a href="#" class="btn btn-success btn-sm disabled" ><i class="fa-solid fa-check"></i></a>
                              @endif
                           </td>
                        </tr>
                        @php $count++; @endphp
                        @endforeach
                        
                     </tbody>
                  </table>
               </div>
               @if(count($repayments) > 0)
               <div class="tab-pane fade mt-4" id="schedule">
                  <table class="table table-bordered schedule-table">
                     <thead>
                        <tr>
                           <th>{{ _lang("No. of Payments") }}</th>
                           <th>{{ _lang("Date") }}</th>
                           <th class="text-right">{{ _lang("Amount to Pay") }}</th>
                           {{-- <th class="text-right">{{ _lang("Penalty") }}</th> --}}
                           <th class="text-right">{{ _lang("Interest") }}</th>
                           
                           <th class="text-right">{{ _lang("Principal Amount") }}</th>
                           <th class="text-right">{{ _lang("Loan Balance") }}</th>

                           @foreach($transactionFees as $transactionFee)
                           @if($loan->applied_amount >= $transactionFee->amount_from && $loan->applied_amount < $transactionFee->amount_to)
                              <th class="text-right">{{ $transactionFee->name}}</th>
                           @endif
                           @endforeach
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php 
                          $count = 1;
                          $amount_to_pay = $principal_amount = $interest = $fee = 0;
                          foreach($repayments as $repayment):
                          $amount_to_pay += $repayment['amount_to_pay'];
                          $principal_amount += $repayment['principal_amount'];
                          $interest += $repayment['interest'];

                        @endphp
                        <tr>
                           <td>{{ $count }}</td>
                           <td>{{ $repayment->repayment_date }}</td>
                           <td class="text-right">
                              {{ decimalPlace($repayment['amount_to_pay'], currency($loan->currency->name)) }}
                           </td>
                           {{-- <td class="text-right">
                              {{ decimalPlace($repayment['penalty'], currency($loan->currency->name)) }}
                           </td> --}}
                           <td class="text-right">
                              {{ decimalPlace($repayment['interest'], currency($loan->currency->name)) }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($repayment['principal_amount'], currency($loan->currency->name)) }}
                           </td>
                           
                           <td class="text-right">
                              {{ decimalPlace($repayment['balance'], currency($loan->currency->name)) }}
                           </td>
                           @php
                            foreach($transactionFees as $transactionFee):
                              if($loan->applied_amount >= $transactionFee->amount_from && $loan->applied_amount < $transactionFee->amount_to):
                           @endphp

                              <td  class="text-right">{{ decimalPlace( ( ($repayment->loan->loan_product->transactionFee->contains($transactionFee->id) )? ( $transactionFee->amount / $repayment->loan->loan_product->term ) : "0") , currency($loan->currency->name)) }}</td>
                              @endif
                           @endforeach
                           <td class="text-center">
                              @if($repayment['status'] == 0 && $loan->next_payment->id == $repayment->id)
                                  <a href="{{ route('loans.manual_payment', $repayment->loan_id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-credit-card"></i> {{ _lang('Pay Now') }}</a>
                              @else
                                  <span class="badge badge-secondary">{{ _lang('No Action') }}</span>
                              @endif
                          </td>
                        </tr>

                        @php $count++; @endphp
                        @endforeach
                        <tr>
                          <td>Total</td>
                          <td></td>
                          <td class="text-right">{{decimalPlace($amount_to_pay, currency($loan->currency->name))}}</td>
                          <td class="text-right">{{decimalPlace($interest, currency($loan->currency->name))}}</td>
                          <td class="text-right">{{decimalPlace($principal_amount, currency($loan->currency->name))}}</td>
                          @php
                            foreach($transactionFees as $transactionFee):
                              if($loan->applied_amount >= $transactionFee->amount_from && $loan->applied_amount < $transactionFee->amount_to):
                           @endphp
                          <td class="text-right">
                            {{ decimalPlace( ( ($repayment->loan->loan_product->transactionFee->contains($transactionFee->id) )? ( $transactionFee->amount ) : "0") , currency($loan->currency->name)) }}
                          </td>
                              @endif
                          @endforeach
                          <td></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               @endif

               
            </div>
         </div>
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
   		var url = "{{ route('loans.show',$loan->id) }}";
   	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
   	});

   	@if(isset($_GET['tab']))
   	   $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
   	@endif

   })(jQuery);
</script>
@endsection