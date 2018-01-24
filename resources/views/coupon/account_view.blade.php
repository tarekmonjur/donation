@extends('layouts.layout')
@section('content')

    <h3>Company Account Details
        <a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#addModal">Add Deposit</a>
    </h3>

    <hr>

    <div class="row">
        <div class="col-md-4 table-responsive">
            <h4>Account Info</h4>
            <table class="table table-sm table-bordered">
                <tbody>
                <tr>
                    <td style="font-weight: bold">Company Name</td>
                    <td>{{$account->companyName}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Account Number</td>
                    <td>{{$account->accountNumber}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Current Balance</td>
                    <td>{{$account->currentBalance}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">OnHold</td>
                    <td>{{$account->onHoldAmount}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Withdraw</td>
                    <td>{{$account->withdrawAmount}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Deposit</td>
                    <td>{{$account->depositAmount}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Created</td>
                    <td>{{$account->created}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Updated</td>
                    <td>{{$account->updated}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Status</td>
                    <td>
                        @if(isset($account->isActive) && $account->isActive === true)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                </tr>
                @if($auth->user_type == "admin")
                <tr>
                    <td style="font-weight: bold">Action</td>
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
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-8 table-responsive">
            <h4>Deposit Info</h4>
            <div class="table-responsive">
                <table id="datatable2" class="table table-hover table-bordered">
                    <thead>
                    <tr style="font-size: 12px" class="bg-light">
                        <th>Tx At</th>
                        <th>Tx Amount</th>
                        <th>Tx Note</th>
                        <th>Tx Title</th>
                        <th>Tx Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody style="font-size: 14px">
                    @foreach($txData as $tx)
                        <tr>
                            <td>{{$tx->txAt}}</td>
                            <td>{{$tx->txAmount}}</td>
                            <td>{{$tx->txNote}}</td>
                            <td>{{$tx->txTitle}}</td>
                            <td>{{$tx->txStatus}}</td>
                            <td>
                                @if($tx->txStatus != 'DEPOSIT')
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-info" href="#" onclick="depositInfo('{{json_encode($tx)}}')" data-toggle="modal" data-target="#depositModal">View</a>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ADD Modal -->
    <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="coupon_form" method="post" action="{{url('company-account/deposit')}}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control form-control-sm" name="accountNumber" id="accountNumber" placeholder="Enter account number">
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control form-control-sm" name="code" id="code" placeholder="Enter amount">
                        </div>
                        <div class="form-group">
                            <label for="serial">Serial</label>
                            <input type="text" class="form-control form-control-sm" name="serial" id="serial" placeholder="Enter serial">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deposit Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="deposit_info"></div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script>
        $("#coupon_form").validate({
            rules: {
                accountNumber: "required",
                code: "required",
                serial: "required",
            }
        });

        function depositInfo(data){
            document.getElementById('deposit_info').innerHTML = data;
        }
    </script>
@endsection