@extends('theme.layout')


@section('content')
<!-- Slider Start -->
<section class="banner d-flex align-items-center" style="background: url({{ get_option('home_banner') == '' ? asset('theme/images/slider-bg-1.jpg') : media_images(get_option('home_banner')) }})">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="block">
					<h1 class="mb-3">{{ get_trans_option('main_heading') }}</h1>

					<p class="mb-4 pr-5 text-white">{{ get_trans_option('sub_heading') }}</p>
					<div class="btn-container">
						<a href="{{ get_option('allow_singup') == 'yes' ? route('register') : route('login') }}" target="_blank" class="btn btn-main-2">Get Started <i class="fa-solid fa-angle-right ml-2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section testimonial">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 offset-lg-12">
				<div class="section-title">
					<h2 class="mb-4">About Ascend Finance and Leasing</h2>
					<div class="divider my-4"></div>
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col-lg-12 offset-lg-12">
				<p>Ascend Finance and Leasing is one of the Philippines financing companies disbursing millions of loans since inception. We use traditional and tested credit methods in combination with new technologies. Our credit evaluation system improves constantly, learning and optimizing in response to monthly loan repayment and delinquency data. Loan borrowers can get a loan between 5,000 up to ₱1,000,000.</p>
<p>Ascend Finance and Leasing, Inc. is regulated by Securities and Exchange Commission (SEC) with Company Reg No. 2022080065269-70 and Certificate of Authority No.: F-22-0031-70 issued October 2008. Incorporated with registered office at Punta Dulog Commercial Complex, St. Joseph Avenue, Pueblo de Panay Township, Lawa-an Roxas City.</p>
<p>Ascend Finance and Leasing is a corporation backed by experienced and talented private investors with vast experience in the local Financial Industry.</p>
			</div>
		</div>
	</div>
</section>

{{--
<section class="section testimonial">
	<div class="testimonial-bg" style="background: url(https://ascendfinanceleasing.com/public//theme/images/about-us-main.jpg)"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-6">
				<div class="section-title">
					<h2 class="mb-4"> Who We Are</h2>
					<div class="divider my-4"></div>
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col-lg-6 offset-lg-6">
				<p>Ascend Finance and Leasing is one of the Philippines financing companies disbursing millions of loans since inception. We use traditional and tested credit methods in combination with new technologies. Our credit evaluation system improves constantly, learning and optimizing in response to monthly loan repayment and delinquency data. Loan borrowers can get a loan between 5,000 up to ₱1,000,000.</p>
<p>Ascend Finance and Leasing, Inc. is regulated by Securities and Exchange Commission (SEC) with Company Reg No. 2022080065269-70 and Certificate of Authority No.: F-22-0031-70 issued October 2008. Incorporated with registered office at Punta Dulog Commercial Complex, St. Joseph Avenue, Pueblo de Panay Township, Lawa-an Roxas City.</p>
<p>Ascend Finance and Leasing is a corporation backed by experienced and talented private investors with vast experience in the local Financial Industry.</p>
			</div>
		</div>
	</div>
</section>
--}}

{{--
<section class="section about">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="about-img">
					<img src="{{ get_option('home_about_us_banner') == '' ? asset('theme/images/about-us.jpg') : media_images(get_option('home_about_us_banner')) }}" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-content pl-4 mt-4 mt-lg-0">
					<h2 class="title-color">{{ get_trans_option('home_about_us_heading') }}</h2>
					<p class="mt-4 mb-5">{{ get_trans_option('home_about_us_content') }}</p>

					 <a href="{{ url('/services') }}" class="btn btn-main-2 btn-icon">{{ _lang('Services') }}<i class="fa-solid fa-angle-right ml-3"></i></a> 
				</div>
			</div>
		</div>
	</div>
</section>
--}}

{{--
<section class="cta-section ">
	<div class="container">
		<div class="cta position-relative">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="fa-solid fa-user-doctor"></i>
						<span class="h3">{{ get_option('total_customer',0) }}</span>+
						<p>{{ _lang('Customers') }}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="fa-solid fa-flag"></i>
						<span class="h3">{{ get_option('total_branch',0) }}</span>
						<p>{{ _lang('Branches') }}</p>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="fa-solid fa-credit-card"></i>
						<span class="h3">{{ get_option('total_transactions',0) }}</span>M
						<p>{{ _lang('Total Transactions') }}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="fa-solid fa-globe"></i>
						<span class="h3">{{ get_option('total_countries',0) }}</span>+
						<p>{{ _lang('Supported Country') }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
--}}

<section class="section service gray-bg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="section-title text-center">
					<h2>{{ get_trans_option('home_testimonial_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_testimonial_content') }}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
         <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="contact-block mb-4 mb-lg-0">
                    <i class="fa-solid">1</i>
                    <h5>Quick Online Application</h5>
                    Create an account and tell us how much you want to borrow.
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="contact-block mb-4 mb-lg-0">
                    <i class="fa-sharp fa-solid">2</i>
                    <h5>Credit Evaluation & Approval</h5>
                    We'll call you for a phone interview, and confirmation of infos.
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="contact-block mb-4 mb-lg-0">
                    <i class="fa-solid">3</i>
                    <h5>Receive Your Money</h5>
                    We'll deposit your money to your chosen bank account.
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section testimonial-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>{{ get_trans_option('home_service_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_service_content') }}</p>
				</div>
			</div>
		</div>

		<div class="row">
		@foreach($services as $service)
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-4">
					<div class="icon d-flex align-items-center">
						{!! xss_clean($service->icon) !!}&nbsp; 
						<h4 class="mt-3 mb-3">{{ $service->translation->title }}</h4>
					</div>

					<div class="content">
						<p class="mb-4">{{ $service->translation->body }}</p>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>
</section>

<section class="section testimonial  gray-bg">
	<div class="testimonial-bg" style="padding: 5%;">
	    <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="contact-block mb-4 mb-lg-0">
                    <i class="fa-solid fa-headset"></i>
                    <h5>{{ _lang('Call Us') }}</h5>
                    {{ get_option('phone') }}
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="contact-block mb-4 mb-lg-0">
                    <i class="fa-solid fa-envelope"></i>
                    <h5>{{ _lang('Email Us') }}</h5>
                    {{ get_option('email') }}
                </div>
            </div>
        </div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-6">
				<div class="section-title">
				    OUR MISSION
					<h2 class="mb-4">We are here to help you</h2>
					<div class="divider my-4"></div>
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col-lg-6 offset-lg-6">
				<p>We are 100% online, our client does not require to attend personally in the office everything is done by computer or smartphone. </p>
<p>We believe that the convenience of such a service will be a success both for clients and for Ascend too.</p>
			</div>
		</div>
	</div>
</section>



{{--
<section class="section fdr-plan">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>{{ get_trans_option('home_fixed_deposit_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_fixed_deposit_content') }}</p>
				</div>
			</div>
		</div>

		<div class="row">

			@foreach($fdr_plans as $fdr_plan)
			<div class="col-lg-4">
				<div class="fdr-item mb-4">
					<div class="title">
						<div class="d-flex flex-wrap justify-content-between">
							<h4 class="my-3">{{ $fdr_plan->name }}</h4>
							<h4 class="my-3">{{ $fdr_plan->interest_rate }}%</h4>
						</div>
					</div>

					<div class="content">
						<ul class="plan-feature-list pl-0">
							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Duration') }}</span>
								<span>{{ $fdr_plan->duration.' '.ucwords(_dlang($fdr_plan->duration_type)) }}</span>
							</li>
							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Interest Rate') }}</span>
								<span>{{ $fdr_plan->interest_rate.' %' }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Minimum') }}</span>
								<span>{{ decimalPlace($fdr_plan->minimum_amount, currency()) }}</span>
							</li>
							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Maximum') }}</span>
								<span>{{ decimalPlace($fdr_plan->maximum_amount, currency()) }}</span>
							</li>
						</ul>
						<a href="{{ route('fixed_deposits.apply') }}" class="btn btn-main-2 btn-block">{{ _lang('Apply Now') }}</a>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</section>
--}}

{{--
<section class="section loan gray-bg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>{{ get_trans_option('home_loan_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_loan_content') }}</p>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach($loan_plans as $loan_plan)
			<div class="col-lg-4">
				<div class="loan-item mb-4">
					<div class="title">
						<div class="d-flex flex-wrap justify-content-between">
							<h4 class="my-3">{{ $loan_plan->name }}</h4>
							<h4 class="my-3">{{ $loan_plan->interest_rate.' %' }}</h4>
						</div>
					</div>

					<div class="content">
						<ul class="plan-feature-list pl-0">
							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Term') }}</span>
								<span>
									{{ $loan_plan->term }}
									@if($loan_plan->term_period === '+1 month')
										{{ _lang('Month') }}
									@elseif($loan_plan->term_period === '+1 year')
										{{ _lang('Year') }}
									@elseif($loan_plan->term_period === '+1 day')
										{{ _lang('Day') }}
									@elseif($loan_plan->term_period === '+1 week')
										{{ _lang('Week') }}
									@endif
								</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Interest Rate') }}</span>
								<span>{{ $loan_plan->interest_rate.' %' }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Interest Type') }}</span>
								<span>{{ ucwords(str_replace("_"," ", $loan_plan->interest_type)) }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Minimum') }}</span>
								<span>{{ decimalPlace($loan_plan->minimum_amount, currency()) }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Maximum') }}</span>
								<span>{{ decimalPlace($loan_plan->maximum_amount, currency()) }}</span>
							</li>
						</ul>
						<a href="{{ route('loans.apply_loan') }}" class="btn btn-main btn-block">Apply Now</a>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</section>
--}}

{{--
<section class="section testimonial-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="section-title text-center">
					<h2>{{ get_trans_option('home_testimonial_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_testimonial_content') }}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 testimonial-wrap-2">
			@foreach($testimonials as $testimonial)
				<div class="testimonial-block style-2 gray-bg">
					<i class="fa-sharp fa-solid fa-quote-right"></i>

					<div class="testimonial-thumb">
						<img src="{{ media_images($testimonial->image) }}" alt="{{ $testimonial->translation->name }}" class="img-fluid">
					</div>

					<div class="client-info">
						<h4>{{ $testimonial->translation->name }}</h4>
						<p>{{ $testimonial->translation->testimonial }}</p>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</section>
--}}
@endsection
