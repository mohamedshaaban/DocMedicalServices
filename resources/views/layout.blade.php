<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png')}}">
    <title>Radiology</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Menu CSS -->
    <!-- animation CSS -->
    <link href="{{asset('plugins/bower_components/owl.carousel/owl.carousel.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/bower_components/owl.carousel/owl.theme.default.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <link href="{{asset('css/colors/green.css')}}" id="theme"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('style')
</head>
<body dir="ltr">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<input type="text" id='dirlang' value="{{session()->get('locale')}}" hidden>
<div id="wrapper">
@include('partials.topnav')
@include('partials.menu')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Welcome {{Auth::user()->username}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="row row-in">
                               @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center"> 2017 &copy; Radiology </footer>
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('js/custom.min.js')}}"></script>
<script src="{{asset('plugins/bower_components/owl.carousel/owl.carousel.js')}}"></script>
<script src="{{asset('plugins/bower_components/owl.carousel/owl.carousel.min.js')}}"></script>
<!--Style Switcher -->
<script src="{{asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>

@yield('script')
</body>
<script>

    function _successMessage(t)
    {
        $("#alert-success").fadeIn();
        $("#alert-success").fadeOut(t);
    }

    function _failMessage(t)
    {
        $("#alert-fail").fadeIn();
        $("#alert-fail").fadeOut(t);
    }

    function _infoMessage(t)
    {
        $("#alert-info").fadeIn();
        $("#alert-info").fadeOut(t);
    }

    $(document).ready(function () {

//        if($('#dirlang').val()=='ar')
//        {
//            $('body').attr('dir','rtl');
//        }

        if($('#db').val()==1)
        {
            _successMessage(5000);
        }else if($('#db').val()==0)
        {
            _failMessage(5000);
        }else{
            _infoMessage(5000);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('.lang').on('click',function(e){
            e.preventDefault();
            var locale = $(this).attr('clang');

            //console.log(locale);

            var promise = $.ajax({
                type: "POST",
                url: "/language",
                data : {'lang' : locale}
            }).done(function(response) {

            })
                .fail(function() { alert("error"); })
                .always(function() {
                    window.location.reload(true);
                    if(locale=='ar')
                    {
                        $('#wrapper').attr('dir','rtl');
                    }
                });

        });


    });
</script>
</html>
{{--<div class="modal fade out" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: block;">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
                {{--<h4 class="modal-title" id="exampleModalLabel1">New message</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}

            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Send message</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

