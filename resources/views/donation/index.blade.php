@extends('layouts.layout')
@section('content')

    <h2>Donations</h2>
    <div class="table-responsive">
        <table id="datatable1" class="table table-sm table-hover">
            <thead>
            <tr style="font-size: 12px">
                <th>#</th>
                <th>Title</th>
                <th>Disease Stage</th>
                <th>Target Amount</th>
                <th>Target Date</th>
                <th>Collected Amount</th>
                <th>Active Program</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($donations as $donation)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{url('donations/'.$donation->{'_id'})}}">{{$donation->title}}</a></td>
                <td>{{$donation->diseaseStage}}</td>
                <td>{{$donation->targetAmount}}</td>
                <td>{{date("d M Y",strtotime($donation->targetDate))}}</td>
                <td>{{$donation->collectedAmount}}</td>
                <td>@if(isset($donation->isVerified) && $donation->activeProgram) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                <td>
                    @if(isset($donation->isVerified) && $donation->isVerified == true)
                        <span class="badge badge-success">Verified</span>
                    @else
                        <span class="badge badge-danger">Unverified</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        @if(isset($donation->isPartial) && $donation->isPartial == false)
                            @if(isset($donation->isVerified) && $donation->isVerified == true)
                                <a class="btn btn-sm btn-danger" href="#" onclick="return confirmAction('Unverified','Are you sure unverified this?','{{url('/donations/verify/'.$donation->{'_id'}.'/0')}}')">Unverified</a>
                            @else
                                <a class="btn btn-sm btn-success" href="#" onclick="return confirmAction('verify','Are you sure verify this?','{{url('/donations/verify/'.$donation->{'_id'}.'/1')}}')">Verify</a>
                            @endif
                        @endif

                        <a class="btn btn-sm btn-primary" href="{{url('/donations/edit/'.$donation->{'_id'})}}">Edit</a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection