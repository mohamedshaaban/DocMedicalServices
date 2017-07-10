@extends('layout')
@section('content')
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Delete User</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>User</b> Was Not Deleted.
    </div>

    <a href="{{route('user.create')}}" class="btn btn-info">
        Add New User <i class="fa fa-plus fa-lg"></i>
    </a>
    <hr>
    <table Class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>SN</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->group_name}}</td>
                    <th>
                        {!!Form::open(['method' => 'delete','route' => ['user.destroy', $user->id]])!!}
                        {{ csrf_field() }}
                        <a href="{{route('user.edit',$user->id)}}" Class="btn btn-info"><i Class="fa fa-lg fa-pencil"></i></a>
                        <button type="submit" Class="btn btn-danger"><i Class="fa fa-lg fa-trash"></i></button>
                        {!!Form::close()!!}
                    </th>
                </tr>
            @php
                $i++;
            @endphp
            @endforeach
        </tbody>
    </table>
@stop

@section('script')
    <script>
        $(document).ready(function(){
            $('.page-title').html('Create User');

        });
    </script>
@stop