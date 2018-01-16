
@extends('layouts.layout')
@section('content')

    <div class="row justify-content-md-center">
        <div class="list-group col col-md-11">
            <div class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">MR DOCTOR COUPON LISTS. ( MR ID - {{$mr_mobile_no}} )</h5>
                    <small>Total {{count($coupons_details->data)}}</small>
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
                        {{--<input type="text" id="datepicker" name="date" value="{{$old['date'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="Date...">--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}

            <table class="table table-bordered table-hover">
                <thead style="background-color: #effff0;">
                    <tr>
                        <th>SL</th>
                        <th>Coupon SL</th>
                        <th>Doctor Id</th>
                        <th>Doctor Name</th>
                        <th>Coupon Date</th>
                        <th>Prescription</th>
                        <th>Assistant Id</th>
                        <th>Assistant Name</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($coupons_details->data as $info)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$info->coupon_sl}}</td>
                        <td>{{$info->mapped_with_doctor_userid}}</td>
                        <td>{{$info->mapped_with_doctor_name}}</td>
                        <td>{{$info->coupon_map_date}}</td>
                        <td>
                            <img src="{{$info->prescription_image}}" alt="">
                        </td>
                        <td>{{$info->associate_sa_mobile}}</td>
                        <td>{{$info->associate_sa_full_name}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"><h3 class="h5">No data available...</h3></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection