
@extends('layouts.layout')
@section('style')
    <style>
        img {
            vertical-align: middle;
        }

        .img-responsive {
            display: block;
            height: auto;
            max-width: 100%;
        }

        .img-rounded {
            border-radius: 3px;
        }

        .img-thumbnail {
            background-color: #fff;
            border: 1px solid #ededf0;
            border-radius: 3px;
            display: inline-block;
            height: auto;
            line-height: 1.428571429;
            max-width: 100%;
            moz-transition: all .2s ease-in-out;
            o-transition: all .2s ease-in-out;
            padding: 2px;
            transition: all .2s ease-in-out;
            webkit-transition: all .2s ease-in-out;
        }

        .img-circle {
            border-radius: 50%;
        }

        .timeline-centered {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-centered:before, .timeline-centered:after {
            content: " ";
            display: table;
        }

        .timeline-centered:after {
            clear: both;
        }

        .timeline-centered:before, .timeline-centered:after {
            content: " ";
            display: table;
        }

        .timeline-centered:after {
            clear: both;
        }

        .timeline-centered:before {
            content: '';
            position: absolute;
            display: block;
            width: 4px;
            background: #f5f5f6;
            /*left: 50%;*/
            top: 20px;
            bottom: 20px;
            margin-left: 30px;
        }

        .timeline-centered .timeline-entry {
            position: relative;
            /*width: 50%;
            float: right;*/
            margin-top: 5px;
            margin-left: 30px;
            margin-bottom: 10px;
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry.begin {
            margin-bottom: 0;
        }

        .timeline-centered .timeline-entry.left-aligned {
            float: left;
        }

        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
            margin-left: 0;
            margin-right: -18px;
        }

        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
            left: auto;
            right: -100px;
            text-align: left;
        }

        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
            float: right;
        }

        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
            margin-left: 0;
            margin-right: 70px;
        }

        .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
            left: auto;
            right: 0;
            margin-left: 0;
            margin-right: -9px;
            -moz-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .timeline-centered .timeline-entry .timeline-entry-inner {
            position: relative;
            margin-left: -20px;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner:after {
            clear: both;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner:after {
            clear: both;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
            position: absolute;
            left: -100px;
            text-align: right;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
            display: block;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
            font-size: 15px;
            font-weight: bold;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
            font-size: 12px;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
            background: #fff;
            color: #737881;
            display: block;
            width: 40px;
            height: 40px;
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            text-align: center;
            -moz-box-shadow: 0 0 0 5px #f5f5f6;
            -webkit-box-shadow: 0 0 0 5px #f5f5f6;
            box-shadow: 0 0 0 5px #f5f5f6;
            line-height: 40px;
            font-size: 15px;
            float: left;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
            background-color: #303641;
            color: #fff;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
            background-color: #ee4749;
            color: #fff;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
            background-color: #00a651;
            color: #fff;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
            background-color: #21a9e1;
            color: #fff;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
            background-color: #fad839;
            color: #fff;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
            background-color: #cc2424;
            color: #fff;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
            position: relative;
            background: #f5f5f6;
            padding: 1em;
            margin-left: 60px;
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
            content: '';
            display: block;
            position: absolute;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 9px 9px 9px 0;
            border-color: transparent #f5f5f6 transparent transparent;
            left: 0;
            top: 10px;
            margin-left: -9px;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2, .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
            color: #737881;
            font-family: "Noto Sans",sans-serif;
            font-size: 12px;
            margin: 0;
            line-height: 1.428571429;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
            margin-top: 15px;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
            color: #303641;
        }

        .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
            -webkit-opacity: .6;
            -moz-opacity: .6;
            opacity: .6;
            -ms-filter: alpha(opacity=60);
            filter: alpha(opacity=60);
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="list-group col col-md-11">
            <div class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">MR DOCTOR VISIT HISTORY ( MR ID - {{$mr_mobile_no}} )</h5>
                    <small>Total {{count($doctor_visits->data)}}</small>
                </div>
            </div>

            <form class="list-group-item" method="get" action="{{url('mr-doctor-visit-history-search')}}">
                <input type="hidden" name="mr_mobile_no" value="{{$mr_mobile_no}}">
                <input type="hidden" name="token" value="{{$mr_api_token}}">
                <div class="row justify-content-md-center align-items-center">
                    <div class="col-sm-4">
                        <select name="doctor_mobile_no" class="form-control form-control-sm">
                            <option value="">--- All Visit History ---</option>
                            @foreach($doctor_list->data as $dinfo)
                                <option value="{{$dinfo->userid}}" @if($doctor_mobile_no == $dinfo->userid) selected @endif>{{$dinfo->doctor_name}} - ( {{$dinfo->userid}} )</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="date" value="{{$date}}" class="datepicker form-control-sm form-control mb-2 mb-sm-0" placeholder="Date...">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover" style="font-size: 12px!important;">
                <thead style="background-color: #effff0;">
                <tr>
                    <th>SL</th>
                    <th>MR Mobile No</th>
                    <th>Doctor Mobile No</th>
                    <th>Doctor Name</th>
                    <th>Doctor Designation</th>
                    <th>Doctor Education</th>
                    <th>Chamber Name</th>
                    <th>Chamber Address</th>
                    <th>Visit Start</th>
                    <th>Visit End</th>
                    <th>Total Visit Time</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($doctor_visits->data as $info)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$info->smMobileNo}}</td>
                        <td>{{$info->doctorMobileNo}}</td>
                        <td>{{$info->doctorFullname}}</td>
                        <td>{{$info->doctorDesignation}}</td>
                        <td>{{$info->doctorEducation}}</td>
                        <td>{{$info->doctorChamberName}}</td>
                        <td>{{$info->doctorChamberAddress}}</td>
                        <td>{{$info->smVisitStart}}</td>
                        <td>{{$info->smVisitEnd}}</td>
                        <td>{{$info->totalVisitTime}}</td>
                        <td>{{$info->remarks}}</td>
                        <td>
                            {{--<a href="#myMapModal" onclick="initMap({{json_encode($info->visit_geo)}})" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">View Details</a>--}}
                            <a href="#myMapModal" onclick="showMap({{json_encode($info)}})" class="btn btn-sm btn-primary" data-toggle="modal">Timeline</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13"><h3 class="h5">No data available...</h3></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="myMapModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Doctor Visit History Timeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">

                            <div class="timeline-centered">

                                <article class="timeline-entry">

                                    <div class="timeline-entry-inner">

                                        <div class="timeline-icon bg-primary">
                                            <i class="entypo-feather"></i>
                                        </div>

                                        <div class="timeline-label">
                                            <h1 style="font-size: 22px!important;">Visit checked in at : <span id="visitStart"></span></h1>
                                            <h2 id="doctorName"></h2>
                                            {{--<h2 id="doctorDesignation"></h2>--}}
                                            {{--<p id="doctorEducation"></p>--}}
                                            {{--<p id="doctorMobile"></p>--}}
                                        </div>
                                    </div>

                                </article>


                                {{--<article class="timeline-entry">--}}

                                    {{--<div class="timeline-entry-inner">--}}

                                        {{--<div class="timeline-icon bg-secondary">--}}
                                            {{--<i class="entypo-suitcase"></i>--}}
                                        {{--</div>--}}

                                        {{--<div class="timeline-label">--}}
                                            {{--<h2 id="chamberName"></h2>--}}
                                            {{--<p id="chamberAddress"></p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</article>--}}


                                <article class="timeline-entry">

                                    <div class="timeline-entry-inner">

                                        <div class="timeline-icon bg-success">
                                            <i class="entypo-location"></i>
                                        </div>

                                        <div class="timeline-label">
                                            <blockquote>Doctor chamber location and visits map.</blockquote>
                                            <div id="map" style="height: 300px!important; width: 650px!important;"></div>
                                        </div>
                                    </div>

                                </article>


                                <article class="timeline-entry">

                                    <div class="timeline-entry-inner">

                                        <div class="timeline-icon bg-warning">
                                            <i class="entypo-camera"></i>
                                        </div>

                                        <div class="timeline-label">
                                            <h1 style="font-size: 22px!important;">Visit checked out at : <span id="visitEnd"></span></h1>
                                            <blockquote style="font-size: 18px!important;">Total Visit Duration : <span id="TotalVisit"></span></blockquote>
                                        </div>
                                    </div>

                                </article>


                                {{--<article class="timeline-entry begin">--}}

                                    {{--<div class="timeline-entry-inner">--}}

                                        {{--<div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">--}}
                                            {{--<i class="entypo-flight"></i> +--}}
                                        {{--</div>--}}

                                    {{--</div>--}}

                                {{--</article>--}}

                            </div>


                        </div>
                    </div>

                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>

//        $('#myMapModal').on('show.bs.modal', function() {
//            setTimeout( function(){initMap();} , 400);
//        });
//
        function showMap(result){
            document.getElementById('doctorName').innerHTML = result.doctorFullname;
//            document.getElementById('doctorDesignation').innerHTML = result.doctorDesignation;
//            document.getElementById('doctorEducation').innerHTML = result.doctorEducation;
//            document.getElementById('doctorMobile').innerHTML = result.doctorMobileNo;
//            document.getElementById('chamberName').innerHTML = result.doctorChamberName;
//            document.getElementById('chamberAddress').innerHTML = result.doctorChamberAddress;
            document.getElementById('visitStart').innerHTML = result.smVisitStart;
            document.getElementById('visitEnd').innerHTML = result.smVisitEnd;
            document.getElementById('TotalVisit').innerHTML = result.totalVisitTime;

            setTimeout( function(){ console.log(result); initMap(result);} , 400);
        }


        function initMap(result) {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: parseInt(result.doctorChamberLat), lng: parseInt(result.doctorChamberLong)}
            });
            setMarkers(map, result);
        }


        function setMarkers(map, result) {

            var image = {
                url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                // This marker is 20 pixels wide by 32 pixels high.
                size: new google.maps.Size(20, 32),
                // The origin for this image is (0, 0).
                origin: new google.maps.Point(0, 0),
                // The anchor for this image is the base of the flagpole at (0, 32).
                anchor: new google.maps.Point(0, 32)
            };
            // Shapes define the clickable region of the icon. The type defines an HTML
            // <area> element 'poly' which traces out a polygon as a series of X,Y points.
            // The final coordinate closes the poly by connecting to the first coordinate.
            var shape = {
                coords: [1, 1, 1, 20, 18, 20, 18, 1],
                type: 'poly'
            };

            var marker = new google.maps.Marker({
                position: {lat: parseInt(result.doctorChamberLat), lng: parseInt(result.doctorChamberLong)},
                map: map,
                icon: image,
                shape: shape,
                title: result.doctorChamberName,
                zIndex: 1
            });

            var chemberGeos = result.visit_geo;
            for (var i = 0; i < chemberGeos.length; i++) {
                var beach = chemberGeos[i];
                var marker = new google.maps.Marker({
                    position: {lat: parseInt(beach.visit_lat), lng: parseInt(beach.visit_long)},
                    map: map,
                    icon: image,
                    shape: shape,
                    title: result.doctorChamberName,
                    zIndex: i
                });
            }
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBEzSQq69K73ZnTZfBUtoPO3Ry2gvAxkA">
    </script>

    @endsection
