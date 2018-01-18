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
                <h4>Donation Fund</h4>
                <table class="table table-sm table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>App User</th>
                        <th>Individual</th>
                        <th>Amount</th>
                        @if($auth->user_type == "company")
                        <th>Status</th>
                        @else
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($donation->funds as $fund)
                        @if($fund->isVerified == true)
                        <tr>
                            <td>{{$fund->donatorName}}</td>
                            <td>{{$fund->donatorMobile}}</td>
                            <td>{{$fund->donatorEmail}}</td>
                            <td>{{date("d M Y",strtotime($fund->donatedAt))}}</td>
                            <td>@if($fund->isAppUser) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                            <td>@if($fund->isIndividual) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                            <td>{{$fund->donatedAmount}}</td>
                            @if($auth->user_type == "company")
                            <td>
                                <label class="badge badge-success">Verified</label>
                            </td>
                            @else
                            <td>
                                @if($fund->isVerified == false)
                                    <a class="btn btn-success btn-sm" onclick="confirmAction('Verified','Are you sure verify this fund?', '{{url('/donations/fund-verify/'.$donation->_id.'/'.$fund->_id.'/1')}}')" href="#">Verified</a>
                                @else
                                    <a class="btn btn-danger btn-sm" onclick="confirmAction('Unverified','Are you sure Unverified this fund?', '{{url('/donations/fund-verify/'.$donation->_id.'/'.$fund->_id.'/0')}}')" href="#">Unverified</a>
                                @endif
                            </td>
                            @endif
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

    <!-- Modal -->
    <div class="modal fade" id="docModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="viewDoc"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

    <script>
        $(document).ready(function(){
           $(document).on("click", ".docView", function(){
              var img = $(this).html();
              $("#viewDoc").html(img);
              $('#docModal').modal();
           });
        });
    </script>

@endsection