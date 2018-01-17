@extends('layouts.layout')
@section('content')

    <h2>Doctors Program</h2>

    <div class="table-responsive">
        <table id="datatable1" class="table table-sm table-hover">
            <thead>
            <tr style="font-size: 12px">
                <th>#</th>
                <th>Doctor Id</th>
                <th>Name</th>
                <th>Hospital</th>
                <th>Chamber</th>
                <th>Designation</th>
                <th>Speciality</th>
                <th>Reason</th>
                <th>Within</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$doctor->doctorId}}</td>
                    <td>{{$doctor->name}}</td>
                    <td>{{$doctor->hospital}}</td>
                    <td>{{$doctor->chamber}}</td>
                    <td>{{$doctor->Designation}}</td>
                    <td>{{$doctor->Speciality}}</td>
                    <td>{{$doctor->reason}}</td>
                    <td>{{$doctor->within}}</td>
                    <td>{{$doctor->amount}}</td>
                    <td>
                        @if(isset($doctor->isRemoved) && $doctor->isRemoved === true)
                            <span class="badge badge-success">Removed</span>
                        @else
                            <span class="badge badge-danger">Not Removed</span>
                        @endif
                        <br>

                        @if(isset($doctor->isRequestAccepted) && $doctor->isRequestAccepted === true)
                            <span class="badge badge-success">Accepted</span>
                        @else
                            <span class="badge badge-danger">Unaccepted</span>
                        @endif
                        <br>
                        @if(isset($doctor->isApproved) && $doctor->isApproved === true)
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Unapproved</span>
                        @endif
                    </td>
                    <td>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection