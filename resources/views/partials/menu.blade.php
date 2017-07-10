@php
    $user = \Illuminate\Support\Facades\Auth::user();
    $urls = DB::select("SELECT G.name as url_group,U.name,U.href
                FROM url_groups AS G
                INNER JOIN urls AS U
                on(G.id = U.url_group_id)
                INNER JOIN user_type_url AS T
                on(T.url_id = U.id)
                WHERE T.user_type_id = ?
                ORDER BY U.order",[$user->user_type->id]);
    $urls = \Illuminate\Support\Collection::make($urls)->groupBy('url_group');
@endphp
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            @foreach($urls as $group=>$items)
                <li>
                    <a href="#" class="waves-effect">
                        <i data-icon=")" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu">{{$group}} <span class="fa arrow"></span></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @foreach($items as $item)
                            <li><a href="{{$item->href}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>