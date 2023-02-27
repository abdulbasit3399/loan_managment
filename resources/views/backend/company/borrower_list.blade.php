@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h4 class="header-title">Borrowers</h4>

                <div class="ml-auto">
                    <div class="dropdown d-inline-block">


                        <div class="dropdown-menu" aria-labelledby="userFilter">

                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <table id="users_table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>{{ _lang('AC Number') }}</th>
                            <th>{{ _lang('First Name') }}</th>
                            <th>{{ _lang('Middle Name') }}</th>
                            <th>{{ _lang('Last Name') }}</th>
                            <th>{{ _lang('Email') }}</th>
                            <th>{{ _lang('Phone') }}</th>
                            <th>{{ _lang('Status') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($browsers as $user)
                        <tr>
                            <td>
                                <img class="thumb-sm img-thumbnail" src="{{profile_picture($user->profile_picture)}}">
                            </td>
                            <td>{{$user->account_number}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->middle_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>
                                {!!status($user->status)!!}</span>
                                
                            </td>
                            <td>
                                <div class="text-center"><form action="{{action('UserController@destroy', $user['id'])}}" class="text-center" method="post">
                                    <a href="{{action('UserController@show', $user['id'])}}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                    
                                    <a href="{{action('UserController@edit', $user['id'])}}" data-title="{{_lang('Update User')}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-sm btn-remove" type="submit"><i class="fa-solid fa-trash"></i></button>
                                </form></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js-script')

@endsection