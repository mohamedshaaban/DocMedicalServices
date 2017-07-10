@extends('layout')
@section('content')
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Create New URL Group</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>URL</b> Was Not Sent.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Create URL Group!</h4>
        <b>You Could Create URL Group</b> for the NAV bar.
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">First Step : Create Url Group</h3>
                <p class="text-muted m-b-30 font-13">Create Url Groups for Navigation bar which will be the parent for Urls too</p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form id='#form' method="post" action="{{route('urlgroups.store')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">href</label>
                                <input type="text" name="href" class="form-control" id="name" value="#" placeholder="Enter Group Name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Url description</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Group Name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Order</label>
                                <input type="number" name="order" class="form-control" id="name" placeholder="Enter Group Name" required>
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
            $('.page-title').html('Create Url Groups');
        });
    </script>
@stop