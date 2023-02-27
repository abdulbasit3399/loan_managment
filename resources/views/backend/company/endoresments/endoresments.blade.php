@extends('layouts.app')

@section('content')
<style type="text/css">
	.salary-input{
		border: 0;
	    border-bottom: 1px solid black;
	    width: 70px;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h4 class="header-title">{{ _lang('Endorsement Requests') }}</h4>
			</div>
			<div class="card-body">
				<table id="endoresment_requests_table" class="table table-bordered data-table">
					<thead>
					    <tr>
							<th>{{ _lang('User') }}</th>
							<th>{{ _lang('Amount') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					    @foreach($loans as $loan)
					    <tr data-id="row_{{ $loan->id }}">
							<td class='name'>{{ $loan->first_name }} {{ $loan->middle_name }} {{ $loan->last_name }}</td>
							<td>{{  decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td>
							<td class="text-center">
								{{-- <a href="{{ action('CompanyController@approveRequest', $loan['id']) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> {{ _lang('Approve') }}</a> --}}
								<a href="#" data-id="{{$loan->id}}" data-amount="{{  decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}" data-name="{{ ucfirst($loan->first_name).' '.ucfirst($loan->last_name) }}"  class="btn btn-primary btn-sm approve"><i class="fa-solid fa-pen-to-square"></i> {{ _lang('Approve') }}</a>
							</td>
					    </tr>
					    @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form action="{{route('approve_request')}}" method="POST" enctype="multipart/form-data">
    	@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Endorsement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<div>
      			<h5 class="text-center mb-4">EMPLOYER’S CERTIFICATION</h5>
      			<p>I hereby certify that the borrower, <b>Mr./ Ms. <label id="name"></label></b>, has no pending administrative/ criminal case and/or investigation against him/ her by the company, and no notice of resignation, and/or leave of absence without pay have been filed.</p>
      			<p>
      				I certify further that as of today, he/ she is receiving a monthly salary of <input type="number" min="0" name="salary" class="salary-input" required> and is qualified to avail of a loan of <b><label class="amount"></label></b>
      			</p>
      			<br/>
      			<br/>
      			<div class="row">
      				<div class="col-md-6">
      					<p>
		      				Date Signed: <label style="text-decoration: underline;">&nbsp;&nbsp;{{date('d-m-Y')}}&nbsp;&nbsp;</label>
		      			</p>
      				</div>
      				<div class="col-md-6">
		      			<p>	_____________________________
		      				<br/>
							Signature over Printed Name-Authorized Signatory
						</p>
					</div>
      			</div>
      			
      		</div>
        	<input type="hidden" name="id" id="loan_id">
        	<label>Upload your E-signatures</label>
        	<input type="file" required name="e_signatures" accept="image/png, image/jpeg, image/jpg" class="form-control">
        	<small>Upload JPG, JPEG, PNG format</small>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
	$('.approve').click(function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		var amount = $(this).data('amount');
		$('#loan_id').val(id);
		$('#name').html(name);
		$('.amount').html(amount);
		$('#exampleModal').modal('show');
	});
</script>

@endsection