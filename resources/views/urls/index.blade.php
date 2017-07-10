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

    <a href="{{route('urls.create')}}" class="btn btn-info">
       Add New URL <i class="fa fa-plus fa-lg"></i>
    </a>
    <hr>
    <table Class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>SN</th>
            <th>Description</th>
            <th>href</th>
            <th>Order</th>
            <th>Group</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach($urls as $url)
            <tr>
                <td>{{$i}}</td>
                <td>{{$url->description}}</td>
                <td>{{$url->href}}</td>
                <td>{{$url->order}}</td>
                <td>{{$url->urlgroup}}</td>
                <td>
                    {!!Form::open(['method' => 'delete','route' => ['urls.destroy', $url->id]])!!}
                    {{ csrf_field() }}
                    <a href="{{route('urls.edit',$url->id)}}" Class="btn btn-info"><i Class="fa fa-lg fa-pencil"></i></a>
                    <button type="submit" Class="btn btn-danger"><i Class="fa fa-lg fa-trash"></i></button>
                    {!!Form::close()!!}
                </td>
            </tr>
            <?php $i++; ?>
        @endforeach
        </tbody>
    </table>
@stop

@section('script')
    <script>
        $(document).ready(function(){
            $('.page-title').html('URL Management');

        });
    </script>
@stop