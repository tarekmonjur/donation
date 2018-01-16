
@extends('layouts.layout')
@section('content')

    <div class="row justify-content-md-center">
        <div class="list-group col col-md-11">
            <div class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">MY DOCTOR LISTS. ( MR ID - {{$mr_mobile_no}} )</h5>
                    <small>Total {{count($doctor_list->data)}}</small>
                </div>
            </div>

            {{--<form class="list-group-item" method="get" action="">--}}
                {{--<div class="row justify-content-md-center align-items-center">--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<input type="text" name="full_name" value="{{$old['full_name'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="MR Full Name...">--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<input type="text" name="city" value="{{$old['city'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="City...">--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}

            @forelse($doctor_list->data as $info)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-2">
                            <div class="d-flex justify-content-between">
                                @if($info->doctor_profile_photo)
                                    <img src="{{$info->doctor_profile_photo}}" alt="..." class="rounded-circle" style="width: 120px!important; height: 120px!important;">
                                @else
                                    <img src="{{url('/images/placeholder.png')}}" alt="..." class="rounded-circle"style="width: 120px!important; height: 120px!important;">
                                @endif
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{$info->doctor_name}} @if($info->doctor_designation) ( {{$info->doctor_designation}} ) @endif</h6>
                                <a class="btn btn-primary btn-sm" target="_blank" href="{{url('mr-doctor-visit-history/'.encrypt($mr_mobile_no).'/'.encrypt($info->userid).'/'.$mr_api_token)}}">Doctor Visit History</a>
                            </div>
                            <h6 class="mb-1">Specialities : {{$info->doctor_specialities}}</h6>
                            <small class="mb-0">Hospital Name : {{$info->hospital_name or '---'}}</small>
                            <br>
                            <small class="mb-0">Mobile : {{$info->doctor_mobile}}</small>
                            <br>
                            <small class="mb-0">Email : {{$info->doctor_email}}</small>
                            <br>
                            <small >Doctor Address : {{$info->doctor_city}}, {{$info->doctor_area}}, {{$info->doctor_residence_address}}</small>
                            <br>
                            <small class="mb-0">Hospital Address : {{$info->hospital_address}}</small>
                            <br>
                            <small >Chember Address : {{$info->doctor_chember_address}}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div href="#" class="list-group-item">
                    <h3 class="h5">No data available...</h3>
                </div>
            @endforelse
        </div>
    </div>

@endsection