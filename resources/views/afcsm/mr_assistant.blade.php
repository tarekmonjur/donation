
@extends('layouts.layout')
@section('content')

    <div class="row justify-content-md-center">
        <div class="list-group col col-md-11">
            <div class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">DOCTOR ASSISTANT LISTS. ( MR ID - {{$mr_mobile_no}} )</h5>
                    <small>Total {{count($assistant_list->data)}}</small>
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

            @forelse($assistant_list->data as $info)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{$info->sa_full_name}}</h6>
                            </div>
                            <small class="mb-0">Mobile : {{$info->sa_userid}}</small>
                            <br>
                            <small class="mb-0">Email : {{$info->sa_email}}</small>
                            <br>
                            <small class="mb-0">Gender : {{$info->sa_gender}}</small>
                            <br>
                            <small> Address : {{$info->sa_city}}</small>
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