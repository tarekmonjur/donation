@extends('layouts.layout')
@section('content')
    <script>
        var base_url = '{{url('/')}}';
        function callDocs(id) {
            $.ajax({
                url: base_url+"/donations/medical-records-doc/"+id,
                type: "get",
                dataType: "html",
                success: function(data){
                    $("#docs").append(data);
                },
                error: function (error) {

                }
            });
        }

    </script>

    <style>
        .breadcrumb_row{
            background: #f8f9fa!important;
            z-index: 999!important;
            position: fixed;
            width: 100%;
            margin-top: -16px;
        }
        .breadcrumb{
            background: #f8f9fa!important;
            padding-top: .75rem!important;
            padding-bottom: 0px!important;
        }
        .breadcrumb a{color: #28a745!important;}
        .breadcrumb-item+.breadcrumb-item::before{
            content: "|"!important;
        }
    </style>

    <div class="row breadcrumb_row">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#donation">Donation</a></li>
                <li class="breadcrumb-item"><a href="#documents">Documents</a></li>
                <li class="breadcrumb-item"><a href="#patient-profile">Patient Profile</a></li>
                <li class="breadcrumb-item"><a href="#doctor-profile">Doctor Profile</a></li>
                <li class="breadcrumb-item"><a href="#payment-info">Payment Info</a></li>
                <li class="breadcrumb-item"><a href="#doctor-supporting">Doctors Supporting</a></li>
                <li class="breadcrumb-item"><a href="#donation-fund">Donation Fund</a></li>
                @if($auth->user_type == "admin")
                <li class="breadcrumb-item"><a href="#donation-comments">Donation Comments</a></li>
                @endif
            </ol>
        </nav>
    </div>

<section style="margin-top: 60px!important;">
    <h3>Donation Details</h3>
    <p>{{$donation->diseaseHistory or 'No disease history...'}}</p>
    <br>
    <div class="row">
        <div id="donation" class="col-md-4 table-responsive">
            <h4>Donation Info</h4>
            <table class="table table-sm table-bordered">
                <tbody>
                <tr>
                    <td>Title</td>
                    <td>{{$donation->title}}</td>
                </tr>
                <tr>
                    <td>Disease Stage</td>
                    <td>{{$donation->diseaseStage}}</td>
                </tr>
                <tr>
                    <td>Target Amount</td>
                    <td>{{$donation->targetAmount}}</td>
                </tr>
                <tr>
                    <td>Target Date</td>
                    <td>{{date("d M Y", strtotime($donation->targetDate))}}</td>
                </tr>
                <tr>
                    <td>Collected Amount</td>
                    <td>{{$donation->collectedAmount or '0'}}</td>
                </tr>
                <tr>
                    <td>Suffering From</td>
                    <td>{{date("d M Y",strtotime($donation->sufferingFrom))}}</td>
                </tr>
                <tr>
                    <td>Active Program</td>
                    <td>
                        @if(isset($donation->activeProgram) && $donation->activeProgram == true) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        @if(isset($donation->isVerified) && $donation->isVerified == true)
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-danger">Unverified</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Action</td>
                    <td>
                        @if(isset($donation->isPartial) && $donation->isPartial == false)
                            @if(isset($donation->isVerified) && $donation->isVerified == true)
                                <a class="btn btn-sm btn-danger" href="#" onclick="return confirmAction('Unverified','Are you sure unverified this?','{{url('/donations/verify/'.$donation->{'_id'}.'/0')}}')">Unverified</a>
                            @else
                                <a class="btn btn-sm btn-success" href="#" onclick="return confirmAction('verify','Are you sure verify this?','{{url('/donations/verify/'.$donation->{'_id'}.'/1')}}')">Verify</a>
                            @endif
                        @endif

                        @if($auth->user_type != "company")
                            <a class="btn btn-sm btn-primary" href="{{url('/donations/edit/'.$donation->{'_id'})}}">Edit</a>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="documents" class="col-md-8">
            <h4>Documents</h4>
            <div class="row border" id="docs" style="margin: 0px">
                @foreach($donation->docs as $doc)
                    <script> callDocs('{{$doc->_id}}'); </script>
                @endforeach
            </div>
        </div>
    </div>
    <br>

    @if(isset($donation->patientProfile))
        <div class="row">
            <div id="patient-profile" class="col-md-6 table-responsive">
                <h4>Patient Profile</h4>
                <table class="table table-sm table-bordered">
                    <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{$donation->patientProfile->name or '---'}}</td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td>{{$donation->patientProfile->age or ''}}</td>
                    </tr>
                    <tr>
                        <td>Profession</td>
                        <td>{{$donation->patientProfile->profession or '---'}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$donation->patientProfile->address or '---'}}</td>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td>{{$donation->patientProfile->area or '---'}}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{$donation->patientProfile->city or '---'}}</td>
                    </tr>
                    <tr>
                        <td>Contact Info</td>
                        <td>{{$donation->patientProfile->contactInfo or '---'}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            @if(isset($donation->patientProfile->seekingRaisedByDoctorProfile))
                <div class="col-md-6 table-responsive">
                    <h4>Seeking Raised By Doctor</h4>
                    <table class="table table-sm table-bordered">
                        <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{$donation->patientProfile->seekingRaisedByDoctorProfile->id}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$donation->patientProfile->seekingRaisedByDoctorProfile->name}}</td>
                        </tr>
                        <tr>
                            <td>Hospital</td>
                            <td>{{$donation->patientProfile->seekingRaisedByDoctorProfile->hospital}}</td>
                        </tr>
                        <tr>
                            <td>Chamber</td>
                            <td>{{$donation->patientProfile->seekingRaisedByDoctorProfile->chamber}}</td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>{{$donation->patientProfile->seekingRaisedByDoctorProfile->Designation}}</td>
                        </tr>
                        <tr>
                            <td>Speciality</td>
                            <td>{{$donation->patientProfile->seekingRaisedByDoctorProfile->Speciality}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <br>
        <div class="row">
            @if(isset($donation->patientProfile->currentDoctorProfile))
                <div id="doctor-profile" class="col-md-6 table-responsive">
                    <h4>Current Doctor Profile</h4>
                    <table class="table table-sm table-bordered">
                        <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{$donation->patientProfile->currentDoctorProfile->id}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$donation->patientProfile->currentDoctorProfile->name}}</td>
                        </tr>
                        <tr>
                            <td>Hospital</td>
                            <td>{{$donation->patientProfile->currentDoctorProfile->hospital}}</td>
                        </tr>
                        <tr>
                            <td>Chamber</td>
                            <td>{{$donation->patientProfile->currentDoctorProfile->chamber}}</td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>{{$donation->patientProfile->currentDoctorProfile->Designation}}</td>
                        </tr>
                        <tr>
                            <td>Speciality</td>
                            <td>{{$donation->patientProfile->currentDoctorProfile->Speciality}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif

            @if(isset($donation->patientProfile->paymentInfo))
                <div id="payment-info" class="col-md-6 table-responsive">
                    <h4>Payment Info</h4>
                    <table class="table table-sm table-bordered">
                        <tbody>
                        <tr>
                            <td>Payment Type</td>
                            <td>{{$donation->patientProfile->paymentInfo->paymentType}}</td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td>{{$donation->patientProfile->paymentInfo->bankName}}</td>
                        </tr>
                        <tr>
                            <td>Bank Branch</td>
                            <td>{{$donation->patientProfile->paymentInfo->bankBranch}}</td>
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td>{{$donation->patientProfile->paymentInfo->accountNumber}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <br>
        <div class="row" id="doctor-supporting">
            <div class="col-md-12 table-responsive">
                <h4>Doctors Supporting</h4>
                <table class="table table-sm table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Designation</th>
                        <th>Speciality</th>
                        <th>Hospital</th>
                        <th>Chamber</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($donation->patientProfile->doctorsSupporting as $support)
                        <tr>
                            <td>{{$support->name}}</td>
                            <td>{{$support->Designation}}</td>
                            <td>{{$support->Speciality}}</td>
                            <td>{{$support->hospital}}</td>
                            <td>{{$support->chamber}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <br>
    <div class="row" id="donation-fund">
        <div class="col-md-12">
            <div class="table-responsive">
                <h4>Donation Fund
                    @if($auth->user_type == "company")
                    <a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#fundModal">Donate Fund</a>
                    @endif
                </h4>
                <table class="table table-sm table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>App User</th>
                        <th>Individual</th>
                        <th>Amount (BDT)</th>
                        @if($auth->user_type == "company")
                        <th>Status</th>
                        @elseif($auth->user_type == "admin")
                        <th>Status</th>
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($donation->funds as $fund)
                        @if($auth->user_type == "company")
                            @if($fund->isVerified == true)
                            <tr>
                                <td>{{$fund->donatorName}}</td>
                                <td>{{$fund->donatorMobile}}</td>
                                <td>{{$fund->donatorEmail}}</td>
                                <td>{{date("d M Y",strtotime($fund->donatedAt))}}</td>
                                <td>
                                    @if($fund->isAppUser == true)<span class="badge badge-success">{{$fund->userType or ''}}</span> @else <span class="badge badge-danger">{{$fund->userType or ''}}</span>@endif
                                </td>
                                <td>@if($fund->isIndividual) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                                <td>{{$fund->donatedAmount}}</td>
                                <td>
                                    <label class="badge badge-success">Verified</label>
                                </td>
                            </tr>
                            @endif
                        @elseif($auth->user_type == "admin")
                            <tr>
                                <td>{{$fund->donatorName}}</td>
                                <td>{{$fund->donatorMobile}}</td>
                                <td>{{$fund->donatorEmail}}</td>
                                <td>{{date("d M Y",strtotime($fund->donatedAt))}}</td>
                                <td>
                                    @if($fund->isAppUser == true) <span class="badge badge-success">{{$fund->userType or ''}}</span> @else <span class="badge badge-info">{{$fund->userType or ''}}</span> @endif
                                </td>
                                <td>@if($fund->isIndividual == true) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                                <td>{{$fund->donatedAmount}}</td>
                                <td>
                                    @if($fund->isVerified == true)
                                    <label class="badge badge-success">Verified</label>
                                    @else
                                    <label class="badge badge-danger">Unverified</label>
                                    @endif
                                </td>
                                <td>
                                    @if($fund->paymentThrough == "AFC_COUPON" && $fund->isAppUser == false && $fund->isIndividual == false)
                                        @if($fund->isVerified == false)
                                            <a class="btn btn-success btn-sm" onclick="verifyFund('{{url('/donations/pharma-fund-verify/'.$donation->_id.'/'.$fund->_id.'/1')}}')" href="#">Verify</a>
                                        @else
                                            <a class="btn btn-danger btn-sm" onclick="unverifyFund('{{url('/donations/pharma-fund-verify/'.$donation->_id.'/'.$fund->_id.'/0')}}')" href="#">Unverified</a>
                                        @endif
                                    @else
                                        @if($fund->isVerified == false)
                                            <a class="btn btn-success btn-sm" onclick="confirmAction('Verify','Are you sure verify this fund?', '{{url('/donations/fund-verify/'.$donation->_id.'/'.$fund->_id.'/1')}}')" href="#">Verify</a>
                                        @else
                                            <a class="btn btn-danger btn-sm" onclick="confirmAction('Unverified','Are you sure unverified this fund?', '{{url('/donations/fund-verify/'.$donation->_id.'/'.$fund->_id.'/0')}}')" href="#">Unverified</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="7">No data available</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="6" class="text-right"><strong>Total Amount :</strong></td>
                        <td><strong>{{$donation->collectedAmount}}</strong></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="row" id="donation-comments">
        <div class="col-md-12 table-responsive">
            <h4>Comments</h4>
            <table id="datatable1" class="table table-sm table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Date</th>
                    @if($auth->user_type == "admin")
                    <th>Action</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($donation->comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->name}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->at}}</td>
                        @if($auth->user_type == "admin")
                        <td>
                            <a class="btn btn-sm btn-danger" href="#" onclick="return confirmAction('delete','Are you sure delete this?','{{url('/donations/comment-delete/'.$comment->{'_id'})}}')">Delete</a>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="docModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="viewDoc"></div>
            </div>
        </div>
    </div>

    @if($auth->user_type == "company")
    <!-- Add Fund Modal -->
    <div class="modal" id="fundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Donate Fund</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="coupon_form" method="post" action="{{url('donations/add-fund/'.$donation->id)}}">
                    {{--<input type="hidden" name="donationProgramId" value="{{$donation->id}}">--}}
                    {{--<input type="hidden" name="companyAccountNumber" value="{{$accountNumber}}">--}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        {{--<div class="form-group">--}}
                            {{--<label for="donatorName">Donator Name</label>--}}
                            {{--<input type="text" class="form-control form-control-sm" name="donatorName" id="donatorName" placeholder="Enter donator name">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="donatorMobile">Donator Mobile</label>--}}
                            {{--<input type="text" readonly class="form-control form-control-sm" name="donatorMobile" id="donatorMobile" placeholder="Enter donator mobile">--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="donatedAmount">Donated Amount</label>
                            <input type="text" class="form-control form-control-sm" name="donatedAmount" id="donatedAmount" value="0" placeholder="Enter donated amount">
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="amount">Company Name</label>--}}
                            {{--<select class="form-control" name="companyName" id="companyName">--}}
                                {{--<option value="0">-- select company --</option>--}}
                                {{--@foreach($companies as $company)--}}
                                {{--<option value="{{$company->id}}" @if($company->id == $companyId)) selected @endif>{{$company->company_name}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Donate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Pharma Fund Verify Modal -->
    <div class="modal" id="fundVerifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Donate Fund Verify</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="fund_verify_form" method="post" action="">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control form-control-sm" name="remarks" id="remarks" placeholder="enter remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Pharma Fund Unverify Modal -->
    <div class="modal" id="fundUnverifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Donate Fund Unverified</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="fund_unverify_form" method="post" action="">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control form-control-sm" name="remarks" id="remarks" placeholder="enter remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Unverified</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</section>
@endsection

@section('script')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script>
        $(document).ready(function(){
           $(document).on("click", ".docView", function(){
              var img = $(this).html();
              $("#viewDoc").html(img);
              $('#docModal').modal();
           });
        });


        function verifyFund(url){
            document.getElementById('fund_verify_form').setAttribute('action', url);
            $('#fundVerifyModal').modal();
        }

        function unverifyFund(url){
            document.getElementById('fund_unverify_form').setAttribute('action', url);
            $('#fundUnverifyModal').modal();
        }

        $("#fund_unverify_form").validate({
            rules: {
                remarks: "required",
            }
        });
    </script>

@endsection