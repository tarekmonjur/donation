@extends('layouts.layout')
@section('content')

    <h3>Coupon Manager
        <a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#addModal">Create Coupon</a>
    </h3>

    <hr>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
                <th>#</th>
                <th>title</th>
                <th>serial</th>
                <th>code</th>
                <th>amount</th>
                <th>created</th>
                <th>updated</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{url('doctors-program/'.$coupon->_id)}}">{{$coupon->title}}</a></td>
                    <td>{{$coupon->serial}}</td>
                    <td>{{$coupon->code}}</td>
                    <td>{{$coupon->amount or '0'}}</td>
                    <td>{{$coupon->created}}</td>
                    <td>{{$coupon->updated}}</td>
                    <td>
                        @if(isset($coupon->isActive) && $coupon->isActive === true)
                            @if(isset($coupon->isUsed) && $coupon->isUsed === true)
                                <span class="badge badge-warning">Used</span>
                            @else
                                <span class="badge badge-success">Unused</span>
                            @endif
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                    @if($auth->user_type == "admin")
                        <td>
                            <div class="btn-group">
                                @if(isset($coupon->isUsed) && $coupon->isUsed === false)
                                    <a href="#" class="btn btn-sm btn-primary" onclick="setCoupon('{{$coupon->amount or '0'}}', '{{$coupon->_id}}')" data-toggle="modal" data-target="#editModal">Edit</a>
                                @endif

                                @if(isset($coupon->isActive) && $coupon->isActive === false)
                                    <a class="btn btn-sm btn-success" href="#" onclick="return confirmAction('Active','Are you sure active this?','{{url('/coupon-manager/change-status/'.$coupon->_id.'/1')}}')">Active</a>
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- ADD Modal -->
    <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="coupon_form" method="post" action="{{url('coupon-manager/create')}}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-sm" name="title" id="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="coupon_no">Total Coupon</label>
                            <input type="text" class="form-control form-control-sm" name="coupon_no" id="coupon_no" placeholder="Enter total coupon">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control form-control-sm" name="amount" id="amount" value="0" placeholder="Enter amount">
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

    <!-- Edit Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="coupon_form" method="post" action="{{url('coupon-manager/update')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="coupon_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="coupon_amount">Amount</label>
                            <input type="text" class="form-control form-control-sm" name="amount" id="coupon_amount" value="0" placeholder="Enter amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script>
        $("#coupon_form").validate({
            rules: {
                title: "required",
                coupon_no: "required",
                amount: {
                    required: true,
                    number: true,
                    min:0
                }

            }
        });

        function setCoupon(amount,id){
            document.getElementById('coupon_id').value = id;
            document.getElementById('coupon_amount').value = amount;
        }
    </script>
@endsection