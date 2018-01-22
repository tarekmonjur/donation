@extends('layouts.layout')
@section('content')

    <h3>Company Account</h3>

    <hr>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
                <th>#</th>
                <th>Company Name</th>
                <th>Account Number</th>
                <th>Current Balance</th>
                <th>OnHold</th>
                <th>Withdraw</th>
                <th>Deposit</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($accounts as $account)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{url('/company-account/'.$account->accountNumber.'/'.$account->companyId)}}">{{$account->companyName}}</a></td>
                    <td>{{$account->accountNumber}}</td>
                    <td>{{$account->currentBalance}}</td>
                    <td>{{$account->onHoldAmount}}</td>
                    <td>{{$account->withdrawAmount}}</td>
                    <td>{{$account->depositAmount}}</td>
                    <td>{{$account->created}}</td>
                    <td>{{$account->updated}}</td>
                    <td>
                        @if(isset($account->isActive) && $account->isActive === true)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            @if(isset($account->isActive) && $account->isActive === false)
                                <a class="btn btn-sm btn-success" href="#" onclick="return confirmAction('Active','Are you sure active this?','{{url('/company-account/change-status/'.$account->accountNumber.'/1')}}')">Active</a>
                            @else
                                <a class="btn btn-sm btn-danger" href="#" onclick="return confirmAction('Inactive','Are you sure inactive this?','{{url('/company-account/change-status/'.$account->accountNumber.'/0')}}')">Inactive</a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

