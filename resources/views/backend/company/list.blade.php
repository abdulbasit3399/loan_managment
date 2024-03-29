@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h4 class="header-title">{{ ucwords(str_replace("_"," ",$status)).' '._lang('Users') }}</h4>

                <div class="ml-auto">
                    <div class="dropdown d-inline-block">
                        {{-- <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="userFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ ucwords(str_replace("_"," ",$status)).' '._lang('Users') }}
                        </button> --}}

                        <div class="dropdown-menu" aria-labelledby="userFilter">
                            {{-- <a class="dropdown-item" href="{{ route('companies.index') }}">{{ _lang('All Users') }}</a>
                            <a class="dropdown-item" href="{{ route('companies.filter') }}/email_verified">{{ _lang('Email Verified') }}</a>
                            <a class="dropdown-item" href="{{ route('companies.filter') }}/email_unverified">{{ _lang('Email Unverified') }}</a>
                            <a class="dropdown-item" href="{{ route('companies.filter') }}/sms_verified">{{ _lang('SMS Verified') }}</a>
                            <a class="dropdown-item" href="{{ route('companies.filter') }}/sms_unverified">{{ _lang('SMS Unverified') }}</a>
                            <a class="dropdown-item" href="{{ route('companies.filter') }}/inactive">{{ _lang('Inactive Users') }}</a> --}}
                        </div>
                    </div>

                    <a class="btn btn-primary btn-sm ajax-modal" data-title="{{ _lang('CREATE COMPANY') }}"
                        href="{{ route('companies.create') }}"><i class="fa-solid fa-circle-plus"></i> {{ _lang('Add New') }}</a>
                </div>
            </div>

            <div class="card-body">
                <table id="users_table" class="table table-bordered" data-status="{{ $status }}">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>{{ _lang('Code') }}</th>
                            <th>{{ _lang('Company Name') }}</th>
                            <th>{{ _lang('Name') }}</th>
                            <th>{{ _lang('Email') }}</th>
                            <th>{{ _lang('Phone') }}</th>
                            <th>{{ _lang('Status') }}</th>
                            <th>{{ _lang('Account Verified') }}</th>
                            <th>{{ _lang('Email Verified') }}</th>
                            <th>{{ _lang('Borrowers') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js-script')
<script src="{{ asset('backend/assets/js/datatables/companies.js?v=1.0') }}"></script>
@endsection