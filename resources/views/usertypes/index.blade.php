@extends('layout')
@section('content')
    <a href="{{route('usertypes.create')}}" class="btn btn-info">
        Add New Role <i class="fa fa-plus fa-lg"></i>
    </a>
    <hr>
    <table Class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>SN</th>
            <th>Role Name</th>
            <th>Creation Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach($user_types as $user_type)
            <tr>
                <td>{{$i}}</td>
                <td>{{$user_type->name}}</td>
                <td>{{$user_type->created_at}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('usertypes.edit',$user_type->id)}}">
                        <i Class="fa fa-pencil fa-lg"></i>
                    </a>
                    {{--<a class="btn btn-danger" href="{{route('usertypes.edit',$user_type->id)}}">--}}
                        {{--<i Class="fa fa-trash fa-lg"></i>--}}
                    {{--</a>--}}
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
            $('.page-title').html('User Groups');

        });
    </script>
@stop