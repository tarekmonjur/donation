@extends('layouts.layout')
@section('content')

    <h3>Doctors Program</h3>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
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
                @if($auth->user_type == "company" || $auth->user_type == "admin")
                <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{url('doctors-program/'.$doctor->id)}}">{{$doctor->doctorId}}</a></td>
                    <td>{{$doctor->name}}</td>
                    <td>{{$doctor->hospital}}</td>
                    <td>{{$doctor->chamber}}</td>
                    <td>{{$doctor->Designation}}</td>
                    <td>{{$doctor->Speciality}}</td>
                    <td>{{$doctor->reason}}</td>
                    <td>{{$doctor->within}}</td>
                    <td>{{$doctor->amount}}</td>
                    <td>
                        @if(isset($doctor->verifiedProgram) && $doctor->verifiedProgram === true)
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-danger">Unverified</span>
                        @endif
                    </td>
                    @if($auth->user_type == "company" || $auth->user_type == "admin")
                    <td>
                        <div class="btn-group">
                            @if(isset($doctor->verifiedProgram) && $doctor->verifiedProgram === true)
                                {{--<a class="btn btn-xs btn-success" href="#" onclick="return confirmAction('Unremoved','Are you sure unremoved this?','{{url('/doctors-program/verified/'.$doctor->id)}}')"></a>--}}
                            @else
                                <a class="btn btn-xs btn-success" href="#" onclick="return confirmAction('Removed','Are you sure removed this?','{{url('/doctors-program/verified/'.$doctor->id)}}')">Verified</a>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection