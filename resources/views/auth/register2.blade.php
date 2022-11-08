@extends('layouts.auth')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<style>
  * {
    margin: 0;
    padding: 0
  }

  html {
    height: 100%
  }

  #grad1 {
    background-color: : #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA)
  }

  #msform {
    text-align: center;
    position: relative;
    margin-top: 20px
  }

  #msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
  }

  #msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
  }

  #msform fieldset:not(:first-of-type) {
    display: none
  }

  #msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
  }

  #msform input,
  #msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px
  }

  #msform input:focus,
  #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0
  }

  #msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
  }

  #msform .action-button:hover,
  #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
  }

  #msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
  }

  #msform .action-button-previous:hover,
  #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
  }

  select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
  }

  select.list-dt:focus {
    border-bottom: 2px solid skyblue
  }

  .card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
  }

  .fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
  }

  #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
  }

  #progressbar .active {
    color: #000000
  }

  #progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative
  }

  #progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023"
  }

  #progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
  }

  #progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d"
  }

  #progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
  }

  #progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
  }

  #progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
  }

  #progressbar li.active:before,
  #progressbar li.active:after {
    background: skyblue
  }

  .radio-group {
    position: relative;
    margin-bottom: 25px
  }

  .radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
  }

  .radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
  }

  .radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
  }

  .fit-image {
    width: 100%;
    object-fit: cover
  }
</style>
@section('content')
@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
<div class="container-fluid" id="grad1">
  <div class="row justify-content-center mt-0">
    <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
      <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
        <h2><strong>Sign Up Your User Account</strong></h2>
        <p>Fill all form field to go to next step</p>
        <div class="row">
          <div class="col-md-12 mx-0">
            <form id="msform" method="POST" class="form-signup" autocomplete="off" action="{{ route('register') }}">
              @csrf
              <!-- progressbar -->
              <ul id="progressbar">
                <li class="active" id="account"><strong>Account</strong></li>
                <li id="personal"><strong>Employment</strong></li>
                <li id="payment"><strong>Personal Refference</strong></li>
                <li id="confirm"><strong>Finish</strong></li>
              </ul> <!-- fieldsets -->
              <fieldset>
                <div class="form-card">
                  <h2 class="fs-title">Account Information</h2> 
                  <input type="text" name="company_code" placeholder="Company Code" /> 
                  <input type="email" name="email" placeholder="Email Id *" /> 
                  <input type="text" name="first_name" placeholder="First Name *" />  
                  <input type="text" name="middle_name" placeholder="Middle Name" />  
                  <input type="text" name="last_name" placeholder="Last Name *" />  
                  <input type="date" name="dob" placeholder="Date of Birth" />
                  <select class="form-control select2" name="country_code" required>
                    <option value="">{{ _lang('Country Code') }}</option>
                    @foreach(get_country_codes() as $key => $value)
                    <option value="{{ $value['dial_code'] }}" {{ old('country_code') == $value['dial_code'] ? 'selected' : '' }}>{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>
                    @endforeach
                  </select>
                  <input type="text" name="home_address" placeholder="Home Address" />  
                  <input type="text" name="barangay" placeholder="Barangay" />  
                  <input type="text" name="city" placeholder="City" />  
                  <input id="phone" type="text" placeholder="{{ _lang('Phone') }}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required> 
                  <input type="text" name="spouse_first_name" placeholder="Spouse First Name" />  
                  <input type="text" name="spouse_middle_name" placeholder="Spouse Middle Name" /> 
                  <input type="text" name="spouse_last_name" placeholder="Spouse Last Name" /> 
                  <input type="password" name="password" placeholder="Password" /> 
                  <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                  <select class="form-control" name="marital_status" id="marital_status">
                    <option value="">Select Martial Status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="widowed">Widowed</option>
                    <option value="seperated">Seperated</option>
                  </select>
                  <br/>
                  <select class="form-control" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div> 
                <input type="button" name="next" class="next action-button" value="Next Step" />
              </fieldset>
              <fieldset>
                <div class="form-card">
                  <h2 class="fssss-title">Employment background</h2> 
                  <input type="text" name="present_employer_name" placeholder="Present Employer Name *" /> 
                  <input type="text" name="present_employer_address" placeholder="Present Employer Address *" /> 
                  <input type="text" name="present_employer_position" placeholder="Current Position *" /> 
                  <input type="text" name="sbu_department" placeholder="SBU/ Department *" /> 
                  <input type="text" name="present_employer_since" placeholder="Start of Employment *" /> 
                  <input type="text" name="present_length_service" placeholder="Length of Service (2 Years) *" /> 
                  <input type="text" name="present_employer_phone" placeholder="Present Employer Phone no *" /> 
                  <input type="text" name="previous_employer_name" placeholder="Previous Employer Name" /> 
                  <input type="text" name="previous_employer_address" placeholder="Previous Employer Address" /> 
                  <input type="text" name="previous_employer_position" placeholder="Previous Position" /> 
                  <input type="date" name="previous_employer_since" placeholder="Previous Employee Since" /> 
                  <input type="text" name="previous_employer_phone" placeholder="Previous Employer  Phone no" /> 
                  <input type="text" name="spouse_present_employer_name" placeholder="Spouse Present Employer Name" /> 
                  <input type="text" name="spouse_present_employer_address" placeholder="Spouse Present Employer Address" /> 
                  <input type="text" name="spouse_present_employer_position" placeholder="Spouse Present Position" /> 
                  <input type="date" name="spouse_present_employer_since" placeholder="Spouse Present Employee Since" /> 
                  <input type="text" name="spouse_present_employer_phone" placeholder="Spouse Present Employer Phone no" /> 
                  <input type="text" name="spouse_previous_employer_name" placeholder="Spouse Previous Employer Name" /> 
                  <input type="text" name="spouse_preious_employer_address" placeholder="Spouse Previous Employer Address" /> 
                  <input type="text" name="spouse_previous_employer_position" placeholder="Spouse Previous Position" /> 
                  <input type="date" name="spouse_previous_employer_since" placeholder="Spouse Previous Employee Since" /> 
                  <input type="text" name="spouse_previous_employer_phone" placeholder="Spouse Previous Employer  Phone no" />
                  <input type="number" name="own_salary" placeholder="Own Salary" />
                  <input type="number" name="other_income" placeholder="Other Income" />
                  <input type="number" name="total_income" placeholder="Total Income" />
                  <input type="number" name="fixed_obligations" placeholder="Fixed Obligation" />
                  <input type="number" name="other_living_expense" placeholder="Other Living Expense" />
                  <input type="number" name="net_monthly_income" placeholder="Net Monthly Income" />
                </div> 
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                <input type="button" name="next" class="next action-button" value="Next Step" />
              </fieldset>
              <fieldset>
                <div class="form-card">
                  <h2 class="fssss-title">Personal Refference</h2> 
                  <input type="text" name="refference_first_name" placeholder="Refference First Name" />  
                  <input type="text" name="refference_last_name" placeholder="Refference Last Name" />  
                  <input type="text" name="refference_company_name" placeholder="Refference Company Name" />
                  <input type="text" name="refference_position" placeholder="Refference Position" />
                  <input type="text" name="refference_address" placeholder="Refference Address" />
                  <input type="text" name="refference_mobile" placeholder="Refference Mobile No" />
                </div> 
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                <input type="button"  name="make_payment" class="next action-button submit" value="Confirm" />
              </fieldset>
              <fieldset>
                <div class="form-card">
                  <h2 class="fs-title text-center">Success !</h2> <br><br>
                  <div class="row justify-content-center">
                    <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                  </div> <br><br>
                  <div class="row justify-content-center">
                    <div class="col-7 text-center">
                      <h5>You Have Successfully Signed Up</h5>
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function(){
    console.log("test");
        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function(){

          current_fs = $(this).parent();
          console.log("current_fs =>",current_fs);
          next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
      },
      duration: 600
    });
      });

        $(".previous").click(function(){

          current_fs = $(this).parent();
          previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
      },
      duration: 600
    });
      });

        $('.radio-group .radio').click(function(){
          $(this).parent().find('.radio').removeClass('selected');
          $(this).addClass('selected');
        });

        $(".submit").click(function(){
          $('form#msform').submit();
        })

      });
    </script>
    @if(get_option('enable_recaptcha', 0) == 1)
    <script src="https://www.google.com/recaptcha/api.js?render={{ get_option('recaptcha_site_key') }}"></script>
    <script>
      grecaptcha.ready(function() {
        grecaptcha.execute('{{ get_option('recaptcha_site_key') }}', {action: 'register'}).then(function(token) {
          if (token) {
            document.getElementById('recaptcha').value = token;
          }
        });
      });
    </script>
    @endif
    @endsection
