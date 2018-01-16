
@extends('layouts.layout')
@section('content')

    <div class="row justify-content-md-center">
        <div class="list-group col col-md-11">
            <div class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">MY MR LISTS.</h5>
                    <small>Total {{count($mr_lists->data)}}</small>
                </div>
            </div>

            <form class="list-group-item" method="get" action="">
                <div class="row justify-content-md-center align-items-center">
                    <div class="col-sm-3 pl-0">
                        <input type="text" name="full_name" value="{{old('full_name')}}" class="form-control form-control-sm mb-2 mb-sm-0" placeholder="MR Full Name...">
                    </div>
                    <div class="col-sm-3 pl-0">
                        <input type="text" name="product" value="{{old('product')}}" class="form-control form-control-sm mb-2 mb-sm-0" placeholder="Product...">
                    </div>
                    {{--<div class="col-sm-3 pl-0">--}}
                        {{--<input type="text" name="doctor" value="{{$old['doctor'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="Doctor...">--}}
                    {{--</div>--}}
                    <div class="col-sm-2 pl-0">
                        <input type="text" name="city" value="{{old('city')}}" class="form-control form-control-sm mb-2 mb-sm-0" placeholder="City...">
                    </div>
                    <div class="col-sm-1 pl-0">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </div>
                </div>
            </form>

            @forelse($mr_lists->data as $info)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-2">
                            <div class="d-flex justify-content-between">
                                @if($info->photo)
                                    <img src="{{$info->photo}}" alt="..." class="rounded-circle" style="width: 120px!important; height: 120px!important;">
                                @else
                                    <img src="{{url('/images/placeholder.png')}}" alt="..." class="rounded-circle" style="width: 120px!important; height: 120px!important;">
                                @endif
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{$info->full_name}} @if($info->position_name) ( {{$info->position_name}} ) @endif</h6>
                                @if($info->company_verify == 'verified')
                                    <small class="text-success">Verified</small>
                                @else
                                    <small class="text-danger">Unverified</small>
                                    <a href="#" onclick="confirmAction('Verify', 'Are you sure verify this?', '{{url('mr-verify/'.$info->experience_id.'/'.$info->mobile_no)}}')" class="btn btn-sm btn-success">Verify</a>
                                @endif
                            </div>
                            <small class="mb-0">Company Name : {{$info->company_name or '---'}}</small>
                            <br>
                            <small class="mb-0">Mobile : {{$info->mobile_no}}</small>
                            <br>
                            <small class="mb-0">Email : {{$info->email}}</small>
                            <br>
                            <small >Address : {{$info->city}}, {{$info->area}}, {{$info->present_address}}</small>
                        </div>
                        <div class="col-1">
                            <a href="{{url('mr-doctor/'.encrypt($info->mobile_no).'/'.$info->api_token)}}" class="btn btn-primary btn-sm mb-2">Doctor</a><br>
                            <a href="{{url('mr-assistant/'.encrypt($info->mobile_no).'/'.$info->api_token)}}" class="btn btn-warning btn-sm mb-2">Assistant</a><br>
                            <a href="{{url('mr-coupons-details/'.encrypt($info->mobile_no).'/'.$info->api_token)}}" class="btn btn-info btn-sm mb-2">Coupons</a><br>
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