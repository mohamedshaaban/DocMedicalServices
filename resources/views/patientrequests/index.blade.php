@extends('layout')
@section('content')
    @php
        $i = 1;
    @endphp
    @if(session()->has('db'))
        <input type="text" value="{{session()->get('db')}}" id="db" hidden />
    @endif
    <div id="alert-success" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>You done it!</h4>
        <b>Request Response</b> Was sent Successfully.
    </div>

    <div id="alert-fail" class="myadmin-alert myadmin-alert-img alert-danger myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Sudden Failure, Sorry!</h4>
        <b>Response</b> Was Not Sent.
    </div>

    <div id="alert-info" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <img src="{{asset('images/logo.png')}}" class="img" alt="img"><a href="#" class="closed">&times;</a>
        <h4>Welcome To Request Response!</h4>
        <b>You Could Send Response</b> for Patient Requests.
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
                                    <button class="btn btn-circle btn-danger"><i class="fa fa-lg fa-thumbs-down"></i>
                                    </button>
                                @elseif($request->status == 'rw')
                                    <button class="btn btn-circle btn-warning"><i class="fa fa-lg fa-hourglass"></i>
                                    </button>
                                @elseif($request->status == 'rr')
                                    <button class="btn btn-circle btn-danger"><i class="fa fa-lg fa-thumbs-down"></i>
                                    </button>
                                @elseif($request->status == 'qw')
                                    <button class="btn btn-circle btn-warning"><i class="fa fa-lg fa-question"></i>
                                    </button>
                                @elseif($request->status == 'qa')
                                    <button class="btn btn-circle btn-success"><i class="fa fa-lg fa-check"></i>
                                    </button>
                                @elseif($request->status == 'qr')
                                    <button class="btn btn-circle btn-danger"><i class="fa fa-lg fa-times"></i></button>
                                @else
                                    <button class="btn btn-circle btn-default"><i class="fa fa-lg fa-refresh"></i>
                                    </button>
                                @endif
                            </div>
                            <div class="pull-right">
                                <a href="#" data-perform="panel-collapse"><i cid="{{$i}}"
                                                                             class="fa fa-chevron-circle-down"></i></a>
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
                                <div class="row">
                                    <hr/>
                                </div>
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
                                <div class="row">
                                    <hr/>
                                </div>

                                <div class="row">
                                    <div align="center" class="col-md-12">
                                        <div class="white-box">
                                            <h3 class="box-title pull-left"><i class="fa fa-image"></i>Uploaded Images :<code
                                                        class="font-12"></code></h3>
                                            <!-- START carousel-->
                                            <div id="carousel-example-captions" data-ride="carousel"
                                                 class="carousel slide">
                                                <ol class="carousel-indicators">
                                                    @if(!empty($request->Uploads))
                                                        <?php $slider = 0; ?>
                                                        @foreach(explode(',',$request->Uploads) as $image)
                                                            <li data-target="#carousel-example-captions"
                                                                data-slide-to="{{$slider}}"
                                                                class="{{($slider == 0)? 'active' : ''}}"></li>
                                                            <?php $slider++; ?>
                                                        @endforeach
                                                    @endif
                                                </ol>
                                                <div role="listbox" class="carousel-inner">
                                                    <?php $checkfirst = 1; ?>
                                                    @if(!empty($request->Uploads))
                                                        @foreach(explode(',',$request->Uploads) as $image)
                                                            <div class="item {{($checkfirst==1)?'active':''}}">
                                                                <a href="../plugins/images/big/img4.jpg"
                                                                   target="_blank"><img
                                                                            src="../plugins/images/big/img4.jpg"
                                                                            alt="First slide image"></a>
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
                                <div class="row">
                                    <hr>
                                </div>
                                <div class="row col-md-12">
                                    <h3 class="col-md-4 box-title"><i Class="fa fa-file-phone-o"></i>Call Confirmation
                                    </h3>
                                    <div class="col-md-3">
                                        <button id='clientaccept{{$i}}' cid="{{$i}}"
                                                class="clientaccept btn btn-success">Client Approval
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button id='clientrefuse{{$i}}' cid="{{$i}}"
                                                class="clientrefuse btn btn-danger">Client Refusal
                                        </button>
                                    </div>
                                    <br><br><br>
                                    <hr class="m-t-0 m-b-40">
                                </div>
                                <hr class="m-t-0 m-b-40">

                                <div id='accept{{$i}}' class="accept row" hidden>
                                    <div class="row">
                                        <h3 class="box-title">Create Client Request</h3>
                                    </div>
                                    <form id='acceptform' action="{{route('patientrequests.store')}}" method="post"
                                          class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="text" name="status" value="rw" hidden>
                                        <input type="text" id="requestno" name="requestno"
                                               value="{{$request->RequestNo}}" hidden>
                                        <input type="text" id="is_at_home" name="is_at_home" value="{{$request->is_at_home}}" hidden/>

                                        @if($request->is_at_home==1)
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Visit Date</label>
                                                    <div class="col-md-9">
                                                        <input id="reservationdate" type="datetime-local" name="deliverydate" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Result Date</label>
                                                    <div class="col-md-9">
                                                        <input id="resultdate1" type="datetime-local" name="estdeiverydate" class="resultdate form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="centersdiv row">
                                            @if($request->is_at_home==0)
                                                <div class="col-md-12 centerdivchild">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Add
                                                                Centers</label>
                                                            <div class="col-md-9">
                                                                <Select class="form-control" id='centerlist1' name='centers[1][center]' required>
                                                                    <option vlaue=""></option>
                                                                    @foreach($centers as $center)
                                                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                                                    @endforeach
                                                                </Select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="col-md-9 input-group">
                                                                <input type='datetime-local' class='form-control'
                                                                       name='centers[1][date]' required>
                                                                <span class="input-group-btn">
                                                                    <button class='add_sub btn btn-success' type="button"><i class="fa fa-lg fa-plus"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Result Date</label>
                                                        <div class="col-md-9">
                                                            <input id="resultdate1" type="datetime-local" name="estdeiverydate" class="resultdate form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div id="section1" cid='1' class="section">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Type</label>
                                                        <div class="col-md-9">
                                                            <Select class='form-control radiologytypelist'
                                                                    clist="radiologycategory1" id='radiologytypelist1'
                                                                    required>
                                                                <option value=""></option>
                                                                @foreach($radiologyTypesCategory as $radiologyTypeCategory)
                                                                    <option value="{{$radiologyTypeCategory->id}}">{{$radiologyTypeCategory->en_name}}</option>
                                                                @endforeach
                                                            </Select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Radiology</label>
                                                        <div class="col-md-9">
                                                            <Select class='form-control' name="radio[1][radiology]"
                                                                    id='radiologycategory1' required>
                                                            </Select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Price</label>
                                                        <div class="col-md-9">
                                                            <input min="0" id="price" type="number"
                                                                   name="radio[1][price]" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--<div class="row">--}}
                                                {{--@if($request->is_at_home==1)--}}
                                                    {{--<div class="col-md-4">--}}
                                                        {{--<div class="form-group">--}}
                                                            {{--<label class="control-label col-md-3">Visit Date</label>--}}
                                                            {{--<div class="col-md-9">--}}
                                                                {{--<input id="reservationdate" type="datetime-local"--}}
                                                                       {{--name="radio[1][reservationdate]"--}}
                                                                       {{--class="form-control" required>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                                {{--<div class="col-md-4">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label col-md-3">Result Date</label>--}}
                                                        {{--<div class="col-md-9">--}}
                                                            {{--<input id="resultdate1" type="datetime-local"--}}
                                                                   {{--name="radio[1][resultdate]"--}}
                                                                   {{--class="resultdate form-control" required>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-1">Definitions</label>
                                                        <div class="col-md-11">
                                                            <textarea id="definitions" rows="1"
                                                                      name="radio[1][definitions]"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-1">Preparation</label>
                                                        <div class="col-md-11">
                                                            <textarea id="preparation" rows="5"
                                                                      name="radio[1][preparation]"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-1">Notes</label>
                                                        <div class="col-md-11">
                                                            <textarea id="notes" rows="5" name="radio[1][notes]"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12 form-actions">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button class="Add btn btn-success">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br><br><br>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="col-md-12 form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button id="submitaccept{{$i}}" type="submit"
                                                                    class="submit btn btn-info">Submit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br><br>
                                    </form>
                                </div>
                                <hr class="m-t-0 m-b-40">
                                <div id='refuse{{$i}}' class="refuse row" hidden>
                                    <div class="row">
                                        <h3 class="box-title">Create Client Refuse</h3>
                                    </div>
                                    <form id='refuseform' method="post" action="{{route('patientrequests.updateRefuse')}}" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="text" name="requestno" value="{{$request->RequestNo}}" hidden>
                                        <input type="text" name="status" value="cr" hidden>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">comment</label>
                                                    <div class="col-md-9">
                                                        <textarea rows="9" name="refuse_comment" class="form-control" required></textarea>
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
                                                            <button id="submitrefuse" type="submit"
                                                                    class="btn btn-success">Submit
                                                            </button>
                                                            <button id="clearrefuse" type="button"
                                                                    class="btn btn-default">Cancel
                                                            </button>
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
            @php $i++; @endphp
        @endforeach
    @endif

@stop

@section('script')
    <script>


        $(document).ready(function () {

            var sectionStart = 1;
            var centeri = 1;
            var currentPanel;
            var radiologyTypes_data = {!! $radiologyTypes !!};

            //var options = $("#radiologytypelist > option").clone();

            $('.page-title').html('Active Patient Requests');

            /*//////////////////////////////// Start Detect current panel //////////////////////////////////////*/
            $('.fa-chevron-circle-down').on('click', function () {
                var id = $(this).attr('cid');
                currentPanel = '.panel' + id;
            });
/*/////////////////////////////// End Detect current panel /////////////////////////////////////////*/

/*/////////////////////////////// Start Call Confirmation JS //////////////////////////////////////*/
            $('.clientaccept').on('click', function () {

                var id = $(this).attr('cid');

                $('#accept' + id).fadeIn('slow');
                $('#accept' + id).attr('hidden', false);
                $('#refuse' + id).fadeOut('slow');
                $('#refuse' + id).attr('hidden', true);
            });

            $('.clientrefuse').on('click', function () {
                var id = $(this).attr('cid');

                $('#refuse' + id).fadeIn('slow');
                $('#refuse' + id).attr('hidden', false);
                $('#accept' + id).fadeOut('slow');
                $('#accept' + id).attr('hidden', true);
            });
/*////////////////////////////////////// End Call Confirmation JS ////////////////////////////////*/

/*////////////////////////////////////// Start Fill in the list //////////////////////////////////*/
            $('.white-box').on("click", '.radiologytypelist', function () {
                var target = $(this).attr('clist');
                var type = $(this).val();
                $(currentPanel).find('#' + target).empty();
                $(currentPanel).find('#' + target).append("<option value=''></option>");
                $.each(radiologyTypes_data, function (index, itemObj) {
                    if (itemObj.type_group_id == type) {
                        $(currentPanel).find('#' + target).append("<option value='" + itemObj.id + "'>" + itemObj.en_name + "</option>");
                    }
                });
            });
/*////////////////////////////////////// Enf Fill in the list ///////////////////////////////////*/

/*/////////////////////////////////////// Add New Section form //////////////////////////////////*/
            $('.white-box').on('click', '.Add', function (e) {
                e.preventDefault();
                $(this).attr('disabled', true);

                var pre_sectionStart = sectionStart;
                sectionStart++;
                centeri = 1;

                var copyEl = [];
                copyEl.push("<div cid=" + sectionStart + " id='section" + sectionStart + "' class='section'>");
                copyEl.push("</br></br></br>");
                copyEl.push("<hr>");
                copyEl.push("<div class='row'>");
                copyEl.push("<div class='col-md-4'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<label class='control-label col-md-3'>Type</label>");
                copyEl.push("<div class='col-md-9'>");
                copyEl.push("<select id='radiologytypelist" + sectionStart + "' clist='radiologycategory" + sectionStart + "' class='radiologytypelist form-control' required>");
                copyEl.push($('#radiologytypelist1').html());
                copyEl.push("</select>");
                copyEl.push("</div></div></div>");

                copyEl.push("<div class='col-md-4'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<label class='control-label col-md-3'>Radiology</label>");
                copyEl.push("<div class='col-md-9'>");
                copyEl.push("<Select class='form-control' name='radio[" + sectionStart + "][radiology]' id='radiologycategory" + sectionStart + "' required>");
                copyEl.push("<option value=''></option>");
                copyEl.push("</Select>");
                copyEl.push("</div></div></div>");

                copyEl.push("<div class='col-md-4'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<label class='control-label col-md-3'>Price</label>");
                copyEl.push("<div class='col-md-9'>");
                copyEl.push("<input min='0' id='price' type='number' name='radio[" + sectionStart + "][price]' class='form-control' required>");
                copyEl.push("</div></div></div></div>");

                copyEl.push("<div class='row'>");
                copyEl.push("<div class='col-md-12'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<label class='control-label col-md-1'>Definitions</label>");
                copyEl.push("<div class='col-md-11'>");
                copyEl.push("<textarea id='definitions' rows='1' name='radio[" + sectionStart + "][definitions]' class='form-control'></textarea>");
                copyEl.push("</div></div></div>");

                copyEl.push("<div class='row'>");
                copyEl.push("<div class='col-md-12'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<label class='control-label col-md-1'>Preparation</label>");
                copyEl.push("<div class='col-md-11'>");
                copyEl.push("<textarea id='preparation' rows='5' name='radio[" + sectionStart + "][preparation]' class=' form-control'></textarea>");
                copyEl.push("</div></div></div>");

                copyEl.push("<div class='col-md-12'>");
                copyEl.push("<div class='form-group' >");
                copyEl.push("<label class='control-label col-md-1' >Notes</label>");
                copyEl.push("<div class='col-md-11'>");
                copyEl.push("<textarea id='notes'  rows='5' name='radio[" + sectionStart + "][notes]' class='form-control'></textarea>");
                copyEl.push("</div></div></div></div>");

//                copyEl.push("<div class='centersdiv row'>");
//                if ($(currentPanel).find('#is_at_home').val() == 0) {
//                    copyEl.push("<div class='col-md-12 centerdivchild'>");
//                    copyEl.push("<div class='col-md-6'>");
//                    copyEl.push("<div class='form-group'>");
//                    copyEl.push("<label class='control-label col-md-3'>Add Centers</label>");
//                    copyEl.push("<div class='col-md-9'>");
//                    copyEl.push("<Select class='form-control' name='radio[" + sectionStart + "][centers]["+1+"][center]' required>");
//                    copyEl.push($('#centerlist1').html());
//                    copyEl.push("</Select>");
//                    copyEl.push("</div></div></div>");
//                    copyEl.push("<div class='col-md-4'>");
//                    copyEl.push("<div class='form-group'>");
//                    copyEl.push("<div class='col-md-9 input-group'>");
//                    copyEl.push("<input type='datetime-local' class='form-control' name='radio[" + sectionStart + "][centers]["+1+"][date]' required/>");
//                    copyEl.push("<span class='input-group-btn'>");
//                    copyEl.push("<button class='add_sub btn btn-success' type='button'><i class='fa fa-lg fa-plus'></i></button>");
//                    copyEl.push("</span>");
//                    copyEl.push("</div></div></div></div>");
//                }
//                copyEl.push("</div>");

                copyEl.push("<div class='col-md-12 form-actions'>");
                copyEl.push("<div class='row'>");
                copyEl.push("<div class='col-md-6'>");
                copyEl.push("<div class='row'>");
                copyEl.push("<div class='col-md-offset-3 col-md-9'>");
                copyEl.push("<button class='Add btn btn-success'>Add</button>&nbsp;");
                copyEl.push("<button class='Remove btn btn-danger'>Remove</button>");
                copyEl.push("</div></div></div></div></div></div>");

                copyEl = $(copyEl.join(''));

                $(currentPanel).find('.section:last').after(copyEl.clone());
            });
/*///////////////////////////////////// End copy Form Section ////////////////////////////////////*/

/*/////////////////////////////////////// Delete section /////////////////////////////////////////*/
            $('.white-box').on("click", ".Remove", function (e) {
                e.preventDefault();
                currentsection = $(this).closest(".section").attr('cid');
                lastsection = $(currentPanel).find('.section:last').attr('cid');

                if (currentsection == lastsection) {
                    $(this).closest(".section").prev().find('.Add').attr('disabled', false);
                }

                $(this).closest(".section").remove();
                $(this).remove();
            });
/*////////////////////////////////////// End delete section /////////////////////////////////////*/

/*////////////////////////////////// Start Control Multi Selection //////////////////////////////*/
            $('.white-box').on('mousedown', '.centers > option', function (e) {
                e.preventDefault();
                $(this).prop('selected', $(this).prop('selected') ? false : true);
                return false;
            });
/*////////////////////////////////// End Control Multi Selection //////////////////////////////*/

/*////////////////////////////////// Start Control Date Selection /////////////////////////////*/
            $('.white-box').on('change', '.resultdate', function () {
                var result_element = $(this);
                var resultdate = $(this).val();
                var reservedate = $(currentPanel).find('input[id*="reservationdate"]').val();
                if (resultdate < reservedate) {
                    result_element.val(" ");
                }
            });
/*/////////////////////////////////// End end Control Date Selection /////////////////////////////*/

/*////////////////////////////////// Start Add Centers in Case of center /////////////////////////*/
            $('.white-box').on('click', '.add_sub', function (e) {
                centeri++;
                e.preventDefault();
                var copyEl = [];
                copyEl.push("<div class='col-md-12 centerdivchild'>");
                copyEl.push("<div class='col-md-6'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<label class='control-label col-md-3'>Add Centers</label>");
                copyEl.push("<div class='col-md-9'>");
                copyEl.push("<Select class='form-control' name='centers[" + centeri + "][center]' required>");
                copyEl.push($('#centerlist1').html());
                copyEl.push("</Select>");
                copyEl.push("</div></div></div>");
                copyEl.push("<div class='col-md-4'>");
                copyEl.push("<div class='form-group'>");
                copyEl.push("<div class='col-md-9 input-group'>");
                copyEl.push("<input type='datetime-local' class='form-control' name='centers[" + centeri + "][date]' required/>");
                copyEl.push("<span class='input-group-btn'>");
                copyEl.push("<button class='remove_sub btn btn-danger' type='button'><i class='fa fa-lg fa-minus'></i></button>");
                copyEl.push("</span>");
                copyEl.push("</div></div></div></div>");

                copyEl = $(copyEl.join(''));

                $(currentPanel).find('.centersdiv').find('.centerdivchild:last').after(copyEl.clone());
                i++;
            });
/*/////////////////////////////// end add centers in case of center ////////////////////////////*/

/*/////////////////////////////// Start Remove  centers in case of center /////////////////////*/
            $('.white-box').on('click', '.remove_sub', function () {
                $(this).closest('.centerdivchild').remove();
            });
/*/////////////////////////////// End Remove centers in case of center ////////////////////////*/
        });
    </script>
@stop