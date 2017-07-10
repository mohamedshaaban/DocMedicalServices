@extends('layout')
@section('content')
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Create New User Role</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>User Role</b> Was Not Done.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Create User Role!</h4>
        <b>You Could Create New User Role</b> that fit your users need.
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">Add and create Create User Role</h3>
                <p class="text-muted m-b-30 font-13"> Create roles for users </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form id='#form' method="post" action="{{route('usertypes.store')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Group Name" required>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('.page-title').html('Create Role');
        });
    </script>
@stop