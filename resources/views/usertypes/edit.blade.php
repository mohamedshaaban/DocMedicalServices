@extends('layout')
@section('content')
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Update User Role</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>User Role Update</b> Was Not Done.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Update User Role!</h4>
        <b>You Could Update New User Role</b> that fit your users need.
    </div>
    <div class="col-md-12">
            <div class="white-box">
                <h4 class="box-title m-b-0">Edit - <b style="color:orangered;">{{$user_types->name}}</b> - Role</h4>
                <p class="text-muted m-b-30 font-13"> Edit Role Children and assign or remove links </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form id='#form' method="patch" action="{{route('usertypes.batchUpdate')}}">
                            <input type="text" name="user_type_id" value="{{$user_types->id}}" hidden>
                            @php
                                $start = 0;
                                $oldlink;
                            @endphp
                            @foreach($links as $link)
                                    @if(empty($oldlink))
                                    <div class="form-group">
                                        <div class="alert alert-info"><h4>{{$link->url_group}}</h4></div>
                                    </div>
                                        @php
                                            $oldlink = $link->url_group;
                                        @endphp
                                    @elseif(!empty($oldlink) && $oldlink != $link->url_group)
                                            @php
                                                $oldlink = $link->url_group;
                                            @endphp
                                            <hr>
                                            <div class="form-group">
                                                <div class="alert alert-info"><h4>{{$link->url_group}}</h4></div>
                                            </div>
                                            <hr>
                                    @else
                                    @endif

                                        <div align="left" class="form-group">
                                            <input name="url_id[{{$start}}]" id="url_id" type="checkbox" value="{{$link->url_id}}" {{$link->Checked}}>
                                            <label for="name">{{$link->url_name}}</label>
                                        </div>
                                @php $start++; @endphp
                            @endforeach

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('.page-title').html('Edit Role Details');
        });
    </script>
@stop