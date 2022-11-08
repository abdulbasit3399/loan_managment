<style type="text/css">
	@page { margin: 0px; }
	body { margin: 0px; }
</style>
	<br/>
	<br/>
	<br/>
	<div style="padding-left: 55px;padding-right: 55px;">
		<h4 style="text-align: center;margin-bottom: 20px;">EMPLOYER’S CERTIFICATION</h4>
		<p>I hereby certify that the borrower, <b>Mr./ Ms. {{$data['user_name']}}</b>, has no pending administrative/ criminal case and/or investigation against him/ her by the company, and no notice of resignation, and/or leave of absence without pay have been filed
		</p>
		<p>
			I certify further that as of today, he/ she is receiving a monthly salary of {{$data['salary']}} and is qualified to avail of a loan of <b>{{$data['loan']}}</b>
		</p>
		<br/>
		<br/>
		<div class="row" style="display:flex">
			<div style="width: 50%">
				<br>
				<br>
				<p>
					Date Signed: <label style="text-decoration: underline;">&nbsp;&nbsp;{{$data['date']}}&nbsp;&nbsp;</label>
				</p>
			</div>
			<div style="width: 50%">

				<p>
				<img src="{{public_path()."/uploads/".$data['signature']}}" style="width: 100px;height:50px"><br/>
				Signature over Printed Name-Authorized Signatory
			</p>
		</div>
		</div>
		
	</div>


