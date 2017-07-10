@extends('layout')
@section('content')
    @php $i=1; @endphp
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Request Confirmation</b> Was sent Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>Confirmation</b> Was Not Sent.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Request Confirmation!</h4>
        <b>You Could Final Confirmation</b> According to Patient Answers.
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

    @if(!empty($requests))
        @foreach($requests as $request)
            <div class="col-lg-12 col-sm-4">
                <div class="panel panel-info panel{{$i}}">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-1">{{$i}}</div>
                            <div class="col-sm-3">{{$request->PatientName}}</div>
                            <div class="col-sm-3">{{$request->RequestDate}}</div>
                            <div class="col-sm-3">{{$request->Location}}</div>
                            <div class="col-sm-1">
                                @if($request->status == 'cr')
                                    <button class="btn btn-circle btn-danger"><i class="fa fa-lg fa-thumbs-down"></i></button>
                                @elseif($request->status == 'rw')
                                    <button class="btn btn-circle btn-warning"><i class="fa fa-lg fa-hourglass"></i></button>
                                @elseif($request->status == 'rr')
                                    <button class="btn btn-circle btn-danger"><i class="fa fa-lg fa-thumbs-down"></i></button>
                                @elseif($request->status == 'qw')
                                    <button class="btn btn-circle btn-warning"><i class="fa fa-lg fa-question"></i></button>
                                @elseif($request->status == 'qa')
                                    <button class="btn btn-circle btn-success"><i class="fa fa-lg fa-check"></i></button>
                                @elseif($request->status == 'qr')
                                    <button class="btn btn-circle btn-danger"><i class="fa fa-lg fa-times"></i></button>
                                @else
                                    <button class="btn btn-circle btn-default"><i class="fa fa-lg fa-refresh"></i></button>
                                @endif
                            </div>
                            <div class="pull-right">
                                <a href="#" data-perform="panel-collapse"><i cid="{{$i}}" class="fa fa-chevron-circle-down"></i></a>
                                {{--<a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse out" aria-expanded="true">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-2"><b><i Class="fa fa-barcode"></i> Patient Code :</b>
                                        {{$request->PatientCode}}
                                    </div>
                                    <div class="col-sm-2"><b><i Class="fa fa-venus-mars "></i> Gender :</b>
                                        {{($request->PatientGender) == 'M'? 'Male' : 'Female'}}
                                    </div>
                                    <div class="col-sm-2"><b><i Class="fa fa-calendar"></i> Age :</b>
                                        {{$request->Age}}
                                    </div>
                                    <div class="col-sm-2"><b><i Class="fa fa-sort-numeric-asc"></i> Weight : </b>
                                        {{$request->Weight}}
                                    </div>
                                    <div class="col-sm-2"><b><i Class="fa fa-bed"></i> Stable : </b>
                                        {{$request->Stable}}
                                    </div>
                                    <div class="col-sm-2"><b><i Class="fa fa-map-marker"></i> At Home : </b>
                                        {{$request->Location}}
                                    </div>
                                </div>
                                <div class="row"><hr/></div>
                                <div class="row">
                                    <div class="col-sm-4"><b><i Class="fa fa-envelope"></i> Email : </b>
                                        {{$request->email}}
                                    </div>
                                    <div class="col-sm-3"><b><i class="fa fa-phone"></i> Phones :</b>
                                        @if(!empty($request->Phones))
                                            @foreach(explode(',',$request->Phones) as $phone))
                                            <div class="row pull-right">{{$phone}}</div>
                                            @endforeach
                                        @else
                                            {{'N/A'}}
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><b><i class="fa fa-home"></i>Address :</b>
                                        <br>
                                        @if(!empty($request->Addresses))
                                            @foreach(explode(',',$request->Addresses) as $address)
                                                <div class="col-sm-8 pull-right">{{$address}}</div>
                                            @endforeach
                                        @else
                                            {{'N/A'}}
                                        @endif
                                    </div>
                                </div>
                                <div class="row"><hr/></div>

                                <div class="row">
                                    <div align="center" class="col-md-12">
                                        <div class="white-box">
                                            <h3 class="box-title pull-left"><i class="fa fa-image"></i>Uploaded Images :<code class="font-12"></code></h3>
                                            <!-- START carousel-->
                                            <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                                <ol class="carousel-indicators">
                                                    @if(!empty($request->Uploads))
                                                        <?php $slider = 0; ?>
                                                        @foreach(explode(',',$request->Uploads) as $image)
                                                            <li data-target="#carousel-example-captions" data-slide-to="{{$slider}}" class="{{($slider == 0)? 'active' : ''}}"></li>
                                                            <?php $slider++; ?>
                                                        @endforeach
                                                    @endif
                                                </ol>
                                                <div role="listbox" class="carousel-inner">
                                                    <?php $checkfirst=1; ?>
                                                    @if(!empty($request->Uploads))
                                                        @foreach(explode(',',$request->Uploads) as $image)
                                                            <div class="item {{($checkfirst==1)?'active':''}}">
                                                                <a href="../plugins/images/big/img4.jpg" target="_blank"><img src="../plugins/images/big/img4.jpg" alt="First slide image"></a>
                                                            </div>
                                                            <?php $checkfirst++; ?>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- END carousel-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row"><hr></div>
                                <div class="row col-md-12">
                                    <h3 class="col-md-4 box-title"><i Class="fa fa-file-phone-o"></i>Center Confirmation</h3>

                                    <div class="answercontent">
                                    </div>

                                </div>
                                    <div class="row"><hr></div>
                                <div class="row col-md-12">
                                    <h3 class="col-md-4 box-title"><i Class="fa fa-file-phone-o"></i>Center Confirmation</h3>
                                    <div class="col-md-3">
                                        <form action="{{route('centerresponses.store')}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="text" name="status"    value="qa" hidden>
                                            <input type="text" name="requestno" value="{{$request->RequestNo}}" hidden>
                                        <button id='centeraccept{{$i}}' cid="{{$i}}" type='submit' class="centeraccept btn btn-success">Center Approval</button>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                        <button id='centerrefuse{{$i}}' cid="{{$i}}" class="centerrefuse btn btn-danger">Center Refusal</button>
                                    </div>
                                    <br><br><br>
                                    <hr class="m-t-0 m-b-40">
                                </div>
                                <hr class="m-t-0 m-b-40">
                                <div id='refuse{{$i}}' class="refuse row" hidden>
                                    <div class="row">
                                        <h3 class="box-title">Create Center Refuse</h3>
                                    </div>
                                    <form action="{{route('patientrequests.updateRefuse')}}" method="post" id='refuseform' class="form-horizontal" >
                                        {{ csrf_field() }}
                                        <input type="text" name="requestno" value="{{$request->RequestNo}}" hidden>
                                        <input type="text" name="status" value="qr" hidden>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">comment</label>
                                                    <div class="col-md-9">
                                                        <textarea rows="9" name='refuse_comment' class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button id="submitrefuse" type="submit" class="btn btn-success">Submit</button>
                                                            <button id="clearrefuse" type="button" class="btn btn-default">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; ?>
        @endforeach
    @endif

@stop
@section('script')
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


        $(document).ready(function(){

            var sectionStart = 1;
            var currentPanel;

            $('.page-title').html('Center Final Confirmations');

            if($('#db').val()==1)
            {
                _successMessage(4000);
            }else if($('#db').val()==0)
            {
                _failMessage(4000);
            }else{
                _infoMessage(4000);
            }

////////////////////// Start Detect current panel //////////////////////
            $('.fa-chevron-circle-down').on('click',function(){
                var id = $(this).attr('cid');
                var question = '';
                currentPanel = '.panel'+id;

                var promise = $.ajax({
                    type: "POST",
                    url: "/answersAjax",
                    data : {'id' : id}
                }).done(function(response) {
                    $.each(JSON.parse(response),function(index,itemObj){
                          if(itemObj.QuestionAnswerBool == 1)
                          {
                              question += "<div class='alert alert-info col-md-12'>"+
                                          "<div class='col-md-10 pull-left'>"+itemObj.EnQusestion+"</div>"+
                                          "<div style='text-align: center;' class='col-md-2 pull-right'>"+itemObj.QuestionAnswerStr+"</div>"+
                                          "</div>";
                          }else{
                              question += "<div class='alert alert-danger col-md-12'>"+
                                  "<div class='col-md-10 pull-left'>"+itemObj.EnQusestion+"</div>"+
                                  "<div style='text-align: center;' class='col-md-2 pull-right'>"+itemObj.QuestionAnswerStr+"</div>"+
                                  "</div>";
                          }
                        });
                    })
                    .fail(function() {
                        question += "<div class='alert alert-warning col-md-12'>"+
                                    "<div class='col-md-12 pull-left'>Questions Cannot be loaded</div>"+
                                    "</div>";
                    })
                    .always(function() {
                          $(currentPanel).find('.answercontent').html(question);
                    });
            });
////////////////////// End Detect current panel //////////////////////
            $('.centerrefuse').on('click',function()
            {
                var id = $(this).attr('cid');
                $('#refuse'+id).fadeToggle("slow");
            });
        });




    </script>
@stop