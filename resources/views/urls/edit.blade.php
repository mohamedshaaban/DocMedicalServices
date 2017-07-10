@extends('layout')
@section('content')
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Edit URL</b> Was Done Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>URL</b> Was Not Updated.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Edit URL!</h4>
        <b>You Could Edit URL</b> for the NAV bar.
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">Edit Urls</h3>
                <p class="text-muted m-b-30 font-13"> Edit a child Url and assign it to New Parent Group Url group </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        {!!Form::open(['method' => 'patch','route' => ['urls.update', $url->id]])!!}
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">href</label>
                                <input type="text" name="href" class="form-control" value="{{$url->href}}" id="name" placeholder="Enter Group Name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Url title</label>
                                <input type="text" name="name" class="form-control" value="{{$url->name}}" id="name" placeholder="Enter Group Name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Group Name</label>
                                <select name="url_group_id" class="form-control" id="url_group_id" required>
                                    <option value=""></option>
                                    @foreach($url_groups as $url_group)
                                        <option value="{{$url_group->id}}"
                                        @if($url_group->id == $url->url_group_id)
                                                selected="selected"
                                        @endif
                                                >{{$url_group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Order</label>
                                <input type="number" name="order" value="{{$url->order}}" class="form-control" id="name" placeholder="Enter Group Name" required>
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
            $('.page-title').html('Create Url');
        });
    </script>
@stop