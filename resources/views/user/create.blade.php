@extends('home')
@section('content')
    {{--
            'name'=>'required',
            'username'=>'bail|required|min:6|unique:users',
            'password'=>'bail|required|min:6',
            'password_confirmation'=>'confirmed',
            'user_type'=>'required'
    --}}
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Create New User</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>User</b> Was Not Sent.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Create User!</h4>
        <b>You Could Create New User</b> Choose User Role Carefully.
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
                    <form id='#form' method="post" action="{{route('user.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password1">Password</label>
                            <input type="password" name="password" class="form-control" id="password1" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password2">Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Group</label>
                            <Select class="form-control" name="user_type_id" id="user_type_id" placeholder="Choose Group" required>
                                <option value=""></option>
                                @foreach($userTypes as $userType)
                                    <option value="{{$userType->id}}">{{$userType->name}}</option>
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
    <script src="{{asset('plugins/bower_components/jquery-validation/dist/jquery.validate.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/dist/jquery.validate.min.js')}}"></script>

    <script>
        $(document).ready(function(){

            $('.page-title').html('Create User');

            $('#form').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 30,
                    } ,
                    password_confirmation: {
                        equalTo: "#password",
                        minlength: 6,
                        maxlength: 30
                    }
                },
                messages:{
                    password: {
                        required:"the password is required"
                    }
                }
            });
        });
    </script>
@stop