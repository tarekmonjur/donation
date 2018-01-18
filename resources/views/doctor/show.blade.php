@extends('layouts.layout')
@section('content')

    <section>
        <h3>Doctor Program Details</h3>
        <p>{{$doctor->title or 'No Title...'}}</p>
        <br>
        <div class="row">
            <div id="donation" class="col-md-5 table-responsive">
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
            <div id="documents" class="col-md-7 table-responsive">
                <h4>Fund</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr style="font-size: 12px" class="bg-light">
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 14px">
                        @foreach($doctor->supportedBy as $fund)
                            <tr>
                                <td>{{$fund->donatorName}}</td>
                                <td>{{$fund->donatorMobile}}</td>
                                <td>{{$fund->donatorEmail}}</td>
                                <td>{{$fund->donatedAt}}</td>
                                <td>{{$fund->donatedAmount}}</td>
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
@endsection