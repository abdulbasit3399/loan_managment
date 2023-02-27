@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="header-title">{{ _lang('Update User') }}</h4>
      </div>
      <div class="card-body">
        <form method="post" class="validate" autocomplete="off"
        action="{{ action('UserController@update', $id) }}" enctype="multipart/form-data">
        {{ csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Select Company') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select select2" name="company_id" data-selected="{{ $user->company_id }}">
                  <option value="">Select Company</option>
                  @foreach($companies as $comp)
                    <option value="{{$comp->id}}" {{$comp->id == $user->company_id ? 'selected' : ''}}>{{$comp->company_name.' - '.$comp->company_code}}</option>
                  @endforeach 
                </select>
                
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('First Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Middle Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}"
                >
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Last Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"
                required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('DOB') }}</label>
              <div class="col-xl-9">
                <input type="date" class="form-control" name="dob" value="{{ $user->dob }}">
              </div>
            </div>

            {{-- <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Account Number') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="account_number" value="{{ $user->account_number }}"
                required>
              </div>
            </div> --}}

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
              <div class="col-xl-9">
                <input type="password" class="form-control" name="password">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>
              <div class="col-xl-9">
                <select class="form-control select2 auto-select" data-selected="{{ $user->country_code }}" name="country_code" required>
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
                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
              </div>
            </div>

            {{-- <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Branch') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select" data-selected="{{ $user->branch_id }}"
                  name="branch_id">
                  <option value="">{{ _lang('Select One') }}</option>
                  {{ create_option('branches','id','name') }}
                </select>
              </div>
            </div> --}}
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="home_address" value="{{ $user->home_address }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse First Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_first_name" value="{{ $user->spouse_first_name }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Middle Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_middle_name" value="{{ $user->spouse_middle_name }}"
                >
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Last Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_last_name" value="{{ $user->spouse_last_name }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Marital Status') }}</label>
              <div class="col-xl-9">
                <select class="form-control" data-selected="{{ $user->marital_status }}"
                name="marital_status">
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="widowed">Widowed</option>
                  <option value="seperated">Seperated</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Company') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select" data-selected="{{ $user->company_id }}"
                  name="company_id">
                  <option value="">{{ _lang('Select One') }}</option>
                  @foreach($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select" data-selected="{{ $user->status }}"
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
                <select class="form-control select2 auto-select" data-selected="{{ $user->email_verified_at }}" name="email_verified_at">
                  <option value="">{{ _lang('No') }}</option>
                  <option value="{{ $user->email_verified_at != null ? $user->email_verified_at : now() }}">{{ _lang('Yes') }}</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>
              <div class="col-xl-9">
                <select class="form-control select2 auto-select" data-selected="{{ $user->sms_verified_at }}" name="sms_verified_at">
                  <option value="">{{ _lang('No') }}</option>
                  <option value="{{ $user->sms_verified_at != null ? $user->sms_verified_at : now() }}">{{ _lang('Yes') }}</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Withdraw Money') }}</label>
              <div class="col-xl-9">
                <select class="form-control auto-select" data-selected="{{ $user->allow_withdrawal }}" name="allow_withdrawal" required>
                  <option value="1">{{ _lang('Allowed') }}</option>
                  <option value="0">{{ _lang('Not Allowed') }}</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
              <div class="col-xl-9">
                <input type="file" class="form-control dropify" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ profile_picture($user->profile_picture) }}">
              </div>
            </div>
            <div class="form-group row">
              <h2>Employment background</h2>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Present Employer Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="present_employer_name" value="{{ $user->present_employer_name }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Present Employer Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="present_employer_address" value="{{ $user->present_employer_address }}"
                >
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Current Position') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="present_employer_position" value="{{ $user->present_employer_position }}"
                required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('SBU/ Department') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="sbu_department" value="{{ $user->sbu_department }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Start of Employment') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="present_employer_since" value="{{ $user->present_employer_since }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Length of Service (2 Years)') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="present_length_service" value="{{ $user->present_length_service }}"
                required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Present Employer Phone no') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="present_employer_phone" value="{{ $user->present_employer_phone }}"
                required>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Previous Employer Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="previous_employer_name" value="{{ $user->previous_employer_name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Previous Employer Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="previous_employer_address" value="{{ $user->previous_employer_address }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Previous Position') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="previous_employer_position" value="{{ $user->previous_employer_position }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Previous Employee Since') }}</label>
              <div class="col-xl-9">
                <input type="date" class="form-control" name="previous_employer_since" value="{{ $user->previous_employer_since }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Previous Employer  Phone no') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="previous_employer_phone" value="{{ $user->previous_employer_phone }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employer Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_present_employer_name" value="{{ $user->spouse_present_employer_name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employer Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_present_employer_address" value="{{ $user->spouse_present_employer_address }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Position') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_present_employer_position" value="{{ $user->spouse_present_employer_position }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employee Since') }}</label>
              <div class="col-xl-9">
                <input type="date" class="form-control" name="spouse_present_employer_since" value="{{ $user->spouse_present_employer_since }}">
              </div>
            </div>


            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Present Employer Phone no') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_present_employer_phone" value="{{ $user->spouse_present_employer_phone }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employer Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_previous_employer_name" value="{{ $user->spouse_previous_employer_name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employer Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_preious_employer_address" value="{{ $user->spouse_preious_employer_address }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Position') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_previous_employer_position" value="{{ $user->spouse_previous_employer_position }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employee Since') }}</label>
              <div class="col-xl-9">
                <input type="date" class="form-control" name="spouse_previous_employer_since" value="{{ $user->spouse_previous_employer_since }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Spouse Previous Employer  Phone no') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="spouse_previous_employer_phone" value="{{ $user->spouse_previous_employer_phone }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Own Salary') }}</label>
              <div class="col-xl-9">
                <input type="number" class="form-control" name="own_salary" min="1" value="{{ $user->own_salary }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Other Income') }}</label>
              <div class="col-xl-9">
                <input type="number" class="form-control" name="other_income" min="1" value="{{ $user->other_income }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Total Income') }}</label>
              <div class="col-xl-9">
                <input type="number" class="form-control" name="total_income" min="1" value="{{ $user->total_income }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Fixed Obligation') }}</label>
              <div class="col-xl-9">
                <input type="number" class="form-control" name="fixed_obligations" min="1" value="{{ $user->fixed_obligations }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Other Living Expense') }}</label>
              <div class="col-xl-9">
                <input type="number" class="form-control" name="other_living_expense" min="1" value="{{ $user->other_living_expense }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Net Monthly Income') }}</label>
              <div class="col-xl-9">
                <input type="number" class="form-control" name="net_monthly_income" min="1" value="{{ $user->net_monthly_income }}">
              </div>
            </div>
            <div class="form-group row">
              <h2>Personal Refference</h2>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Refference First Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="refference_first_name" value="{{ $user->refference_first_name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Refference Last Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="refference_last_name" value="{{ $user->refference_last_name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Refference Company Name') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="refference_company_name" value="{{ $user->refference_company_name }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Refference Position') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="refference_position" value="{{ $user->refference_position }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Refference Address') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="refference_address" value="{{ $user->refference_address }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-form-label">{{ _lang('Refference Mobile No') }}</label>
              <div class="col-xl-9">
                <input type="text" class="form-control" name="refference_mobile" value="{{ $user->refference_mobile }}">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-9 offset-xl-3">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> {{ _lang('Update User') }}</button>
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