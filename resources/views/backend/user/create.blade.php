@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="header-title">{{ _lang('Create User') }}</h4>
      </div>
      <div class="card-body">
        <form method="post" class="validate" autocomplete="off" action="{{ route('users.store') }}"
        enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
          <div class="col-md-8 col-sm-12">
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Select Company') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select select2" name="company_id">
                  <option value="">Select Company</option>
                  @foreach($companies as $comp)
                    <option value="{{$comp->id}}">{{$comp->company_name.' - '.$comp->company_code}}</option>
                  @endforeach 
                </select>
                
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('First Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Middle Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}"
                >
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Last Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                required>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
              <div class="col-xl-9">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('DOB') }}</label>
              <div class="col-xl-9">
                <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
              </div>
            </div>

            {{-- <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Account Number') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}"
                required>
              </div>
            </div> --}}

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
              <div class="col-xl-9">
                <input type="password" class="form-control" name="password" value="" required>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>
              <div class="col-xl-9">
                <select class="form-control select2 auto-select" data-selected="{{ old('country_code') }}" name="country_code" required>
                  <option value="">{{ _lang('Select One') }}</option>
                  @foreach(get_country_codes() as $key => $value)
                  <option value="{{ $value['dial_code'] }}">{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="home_address" value="{{ old('home_address') }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse First Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_first_name" value="{{ old('spouse_first_name') }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Middle Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_middle_name" value="{{ old('spouse_middle_name') }}"
                >
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Last Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_last_name" value="{{ old('spouse_last_name') }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Marital Status') }}</label>
              <div class="col-xl-9">
                <select class="form-control" data-selected="{{ old('marital_status') }}"
                name="marital_status">
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="widowed">Widowed</option>
                  <option value="seperated">Seperated</option>
                </select>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select" data-selected="{{ old('status') }}"
                name="status" required>
                  <option value="">{{ _lang('Select One') }}</option>
                  <option value="1">{{ _lang('Active') }}</option>
                  <option value="0">{{ _lang('In Active') }}</option>
                </select>
              </div>
            </div>

          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Email Verified') }}</label>
            <div class="col-xl-9">
              <select class="form-control select2 auto-select" name="email_verified_at">
                <option value="">{{ _lang('No') }}</option>
                <option value="{{ now() }}">{{ _lang('Yes') }}</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>
            <div class="col-xl-9">
              <select class="form-control select2 auto-select" name="sms_verified_at">
                <option value="">{{ _lang('No') }}</option>
                <option value="{{ now() }}">{{ _lang('Yes') }}</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
            <div class="col-xl-9">
              <input type="file" class="form-control dropify" name="profile_picture">
            </div>
          </div>

          
          <div class="form-group row">
            <h2>Employment background</h2>
          </div>

          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Present Employer Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="present_employer_name" value="{{ old('present_employer_name') }}"
              required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Present Employer Address') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="present_employer_address" value="{{ old('present_employer_address') }}"
              >
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Current Position') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="present_employer_position" value="{{ old('present_employer_position') }}"
              required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('SBU/ Department') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="sbu_department" value="{{ old('sbu_department') }}"
              required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Start of Employment') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="present_employer_since" value="{{ old('present_employer_since') }}"
              required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Length of Service (2 Years)') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="present_length_service" value="{{ old('present_length_service') }}"
              required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Present Employer Phone no') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="present_employer_phone" value="{{ old('present_employer_phone') }}"
              required>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Previous Employer Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="previous_employer_name" value="{{ old('previous_employer_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Previous Employer Address') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="previous_employer_address" value="{{ old('previous_employer_address') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Previous Position') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="previous_employer_position" value="{{ old('previous_employer_position') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Previous Employee Since') }}</label>
            <div class="col-xl-9">
              <input type="date" class="form-control" name="previous_employer_since" value="{{ old('previous_employer_since') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Previous Employer  Phone no') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="previous_employer_phone" value="{{ old('previous_employer_phone') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employer Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_present_employer_name" value="{{ old('spouse_present_employer_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employer Address') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_present_employer_address" value="{{ old('spouse_present_employer_address') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Position') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_present_employer_position" value="{{ old('spouse_present_employer_position') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employee Since') }}</label>
            <div class="col-xl-9">
              <input type="date" class="form-control" name="spouse_present_employer_since" value="{{ old('spouse_present_employer_since') }}">
            </div>
          </div>


          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employer Phone no') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_present_employer_phone" value="{{ old('spouse_present_employer_phone') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employer Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_previous_employer_name" value="{{ old('spouse_previous_employer_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employer Address') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_preious_employer_address" value="{{ old('spouse_preious_employer_address') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Position') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_previous_employer_position" value="{{ old('spouse_previous_employer_position') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employee Since') }}</label>
            <div class="col-xl-9">
              <input type="date" class="form-control" name="spouse_previous_employer_since" value="{{ old('spouse_previous_employer_since') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employer  Phone no') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="spouse_previous_employer_phone" value="{{ old('spouse_previous_employer_phone') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Own Salary') }}</label>
            <div class="col-xl-9">
              <input type="number" class="form-control" name="own_salary" min="1" value="{{ old('own_salary') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Other Income') }}</label>
            <div class="col-xl-9">
              <input type="number" class="form-control" name="other_income" min="1" value="{{ old('other_income') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Total Income') }}</label>
            <div class="col-xl-9">
              <input type="number" class="form-control" name="total_income" min="1" value="{{ old('total_income') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Fixed Obligation') }}</label>
            <div class="col-xl-9">
              <input type="number" class="form-control" name="fixed_obligations" min="1" value="{{ old('fixed_obligations') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Other Living Expense') }}</label>
            <div class="col-xl-9">
              <input type="number" class="form-control" name="other_living_expense" min="1" value="{{ old('other_living_expense') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Net Monthly Income') }}</label>
            <div class="col-xl-9">
              <input type="number" class="form-control" name="net_monthly_income" min="1" value="{{ old('net_monthly_income') }}">
            </div>
          </div>

          <div class="form-group row">
            <h2>Personal Refference</h2>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Refference First Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="refference_first_name" value="{{ old('refference_first_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Refference Last Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="refference_last_name" value="{{ old('refference_last_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Refference Company Name') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="refference_company_name" value="{{ old('refference_company_name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Refference Position') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="refference_position" value="{{ old('refference_position') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Refference Address') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="refference_address" value="{{ old('refference_address') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-form-label">{{ _lang('Refference Mobile No') }}</label>
            <div class="col-xl-9">
              <input type="text" class="form-control" name="refference_mobile" value="{{ old('refference_mobile') }}">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xl-9 offset-xl-3">
              <button type="submit" class="btn btn-primary">{{ _lang('Create User') }}</button>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
@endsection