
@extends('layouts.layout')
@section('content')

    <div class="row justify-content-md-center">
        <div class="list-group col col-md-11">

            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">MY MR LISTS.</h5>
                    <small>Total {{count($mr_lists->data)}}</small>
                </div>
            </a>

            <form class="list-group-item" method="get" action="">
                <div class="row justify-content-md-center align-items-center">
                    <div class="col-sm-3 pl-0">
                        <input type="text" name="full_name" value="{{$old['full_name'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="MR Full Name...">
                    </div>
                    <div class="col-sm-3 pl-0">
                        <input type="text" name="product" value="{{$old['product'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="Product...">
                    </div>
                    <div class="col-sm-3 pl-0">
                        <input type="text" name="doctor" value="{{$old['doctor'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="Doctor...">
                    </div>
                    <div class="col-sm-2 pl-0">
                        <input type="text" name="city" value="{{$old['city'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="City...">
                    </div>
                    <div class="col-sm-1 pl-0">
                        <button type="submit" class="btn btn-primary">Search</button>
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
                        <div class="col-9">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">{{$info->full_name}} @if($info->position_name) ( {{$info->position_name}} ) @endif</h5>
                                @if($info->company_verify == 'verified')
                                    <small class="text-success">Verified</small>
                                @else
                                    <small class="text-danger">Unverified</small>
                                    <a href="{{url('mr-verify/'.$info->experience_id)}}" class="btn btn-success">Verify</a>
                                @endif
                            </div>

                            <p class="mb-1">Company Name : {{$info->company_name or '---'}}</p>
                            <p class="mb-1">Mobile : {{$info->mobile_no}}</p>
                            <p class="mb-1">Email : {{$info->email}}</p>
                            <p class="mb-1"></p>
                            <small class="text-muted">Address : {{$info->city}}, {{$info->area}}, {{$info->present_address}}</small>
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