@extends('layouts.layout')
@section('content')

    <h3>Coupons
        <a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#addModal">Add Coupon</a>
    </h3>

    <hr>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
                <th>#</th>
                <th>Serial</th>
                <th>Code</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">

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
                            <label for="code">code</label>
                            <input type="text" class="form-control form-control-sm" name="code" id="code" value="0" placeholder="Enter amount">
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
                code: "required",
            }
        });

        function setCoupon(amount,id){
            document.getElementById('coupon_id').value = id;
            document.getElementById('coupon_amount').value = amount;
        }
    </script>
@endsection