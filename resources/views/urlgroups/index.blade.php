@extends('layout')
@section('content')
    <a href="{{route('urlgroups.create')}}" class="btn btn-info">
        Add New URL Group <i class="fa fa-plus fa-lg"></i>
    </a>
    <hr>
    <table Class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>SN</th>
            <th>Link</th>
            <th>Group Name</th>
            <th>Order</th>
            <th>Creation Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach($url_groups->sortBy('order') as $url)
            <tr>
                <td>{{$i}}</td>
                <td>{{$url->href}}</td>
                <td>{{$url->name}}</td>
                <td>{{$url->order}}</td>
                <td>{{$url->created_at}}</td>
            </tr>
            <?php $i++; ?>
        @endforeach
        </tbody>
    </table>
@stop

@section('script')
    <script>
        $(document).ready(function(){
            $('.page-title').html('URL Group');

        });
    </script>
@stop