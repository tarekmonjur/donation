@extends('layouts.layout')
@section('content')
    <style>
        label.error{color: red}
    </style>
    <section>
        <h3>Doctor Program Details</h3>
        <p>{{$doctor->title or 'No Title...'}}</p>
        <br>
        <div class="row">
            <div id="donation" class="col-md-4 table-responsive">
                <h4>Donation Info</h4>
                <table class="table table-sm table-bordered">
                    <tbody>
                    <tr>
                        <td style="font-weight: bold">Name</td>
                        <td>{{$doctor->name}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Designation</td>
                        <td>{{$doctor->Designation}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Speciality</td>
                        <td>{{$doctor->Speciality}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Chamber</td>
                        <td>{{$doctor->chamber}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Hospital</td>
                        <td>{{$doctor->hospital}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Title</td>
                        <td>{{$doctor->title}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Reason</td>
                        <td>{{$doctor->reason}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Amount</td>
                        <td>{{$doctor->amount or '0'}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Collected</td>
                        <td>{{$doctor->collected or '0'}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Created Date</td>
                        <td>{{date("d M Y", strtotime($doctor->createdAt))}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Within</td>
                        <td>{{$doctor->within}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Status</td>
                        <td>
                            @if(isset($doctor->verifiedProgram) && $doctor->verifiedProgram === true)
                                <span class="badge badge-success">Verified</span>
                            @else
                                <span class="badge badge-danger">Unverified</span>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="documents" class="col-md-8 table-responsive">
                <h4>Fund Info
                    @if($auth->user_type == "company" || $auth->user_type == "admin")
                    <small><a href="#" class="pull-right btn btn-sm btn-primary" data-toggle="modal" data-target="#fundModal">Add Fund</a></small>
                    @endif
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr style="font-size: 12px" class="bg-light">
                            <th>Name</th>
                            <th>Company</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 14px">
                        @foreach($doctor->supportedBy as $fund)
                            <tr>
                                <td>{{$fund->donatorName}}</td>
                                <td>{{$fund->donatorCompany}}</td>
                                @if($auth->user_type == "admin" || $fund->donatorMobile == $auth->mobile_no)
                                <td>{{$fund->donatorMobile}}</td>
                                <td>{{$fund->donatorEmail}}</td>
                                <td>{{$fund->donatedAmount}}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                                <td>{{$fund->donatedAt}}</td>
                                <td>
                                    @if($fund->isVerified === true)
                                    <label class="badge badge-success">Verified</label>
                                    @else
                                    <label class="badge badge-danger">Unverified</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </section>

    <!-- Modal -->
    <div class="modal" id="fundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Program Fund</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="fund_form" method="post" action="{{url('doctors-program/fund-add')}}">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$doctor->id}}" name="doctorSupportSeekingId">
                    <div class="modal-body">
                        {{--<div class="form-group">--}}
                            {{--<label for="name">Name</label>--}}
                            {{--<input type="hidden" class="form-control form-control-sm" name="name" value="{{$auth->full_name}}" id="name" placeholder="Enter name">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="mobile_no">Mobile No</label>--}}
                            {{--<input type="hidden" class="form-control form-control-sm" name="mobile_no" value="{{$auth->mobile_no}}" id="mobile_no"  placeholder="Enter mobile no">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="email">Email address</label>--}}
                            {{--<input type="hidden" class="form-control form-control-sm" name="email" value="{{$auth->email}}" id="email" placeholder="Enter email">--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control form-control-sm" name="amount" id="amount" placeholder="Enter amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script>
        $("#fund_form").validate({
            rules: {
//                name: "required",
//                mobile_no: "required",
//                email: {
//                    required: true,
//                    email: true
//                },
                amount: {
                    required: true,
                    number: true
                }

            }
        });
    </script>
@endsection