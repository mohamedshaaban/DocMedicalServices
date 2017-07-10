@extends('layout')
@section('content')
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Edit User</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>User</b> Was Not Updated.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Edit User!</h4>
        <b>You Could Edit User</b> While Choosing User Role Carefully.
    </div>

    @if(session()->has('error') || count($errors->all()) > 0)
        <div class="myadmin-alert myadmin-alert-img myadmin-alert-click alert-danger myadmin-alert-bottom alertbottom2" style="display: block;"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">×</a>
            <h4>Please Report the Following Errors</h4>
            <b></b> {{session()->get('error')}} <a href="#" class="closed">×</a> <br>
            @if(count($errors->all() > 0))
                @foreach($errors->all() as $error_val)
                    <b></b> {{$error_val}} <a href="#" class="closed">×</a> <br>
                @endforeach
            @endif
        </div>
    @endif

    <div class="col-md-12">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">Create User</h3>
                <p class="text-muted m-b-30 font-13"> Create User and add it to a group </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        {{--<form id='#form' method="put" action="{{route('user.update',$user->id)}}">--}}
                            {!!Form::open(['method' => 'patch','route' => ['user.update', $user->id]])!!}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}" id="name" placeholder="Enter Full Name" required>
                            </div>
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" class="form-control" value="{{$user->username}}" id="username" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" value="{{$user->email}}" id="email" placeholder="Enter email" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Group</label>
                                <Select class="form-control" name="user_type_id" id="user_type_id" placeholder="Choose Group" required>
                                    <option value=""></option>
                                    @foreach($userTypes as $userType)
                                        <option value="{{$userType->id}}"
                                                @if($userType->id == $user->user_type_id)
                                                selected="selected"
                                                @endif
                                        >{{$userType->name}}</option>
                                    @endforeach
                                </Select>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label class="col-sm-12">Profile Image</label>--}}
                            {{--<input type="file" name="profileimage" class="form-control" id="profileimage" placeholder="profileimage">--}}
                            {{--</div>--}}
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="white-box">

            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function(){
            $('.page-title').html('Edit User');
        });
    </script>
@stop