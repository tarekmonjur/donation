@extends('layouts.layout')
@section('content')
@inject('client', 'App\Http\Controllers\CommonController')
    <h2>Donation Details</h2>
    <p>{{$donation->diseaseHistory}}</p>
    <div class="row">
        <div class="col-md-4 table-responsive">
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
                    <td>{{$donation->collectedAmount}}</td>
                </tr>
                <tr>
                    <td>Suffering From</td>
                    <td>{{date("d M Y",strtotime($donation->sufferingFrom))}}</td>
                </tr>
                <tr>
                    <td>Active Program</td>
                    <td>@if($donation->activeProgram) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
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
                </tbody>
            </table>
        </div>
        <div class="col-md-8">

            <h4>Documents</h4>
            <div class="border">
            @foreach($donation->docs as $doc)
                <div class="col-md-2 pt-1 pb-1">
                    <?php $img = $client->sendMedicalDocRetriveRequest($client->apiUrl.'donation/medical-records/view/'.$doc->{'_id'}.'/1', 'GET'); ?>
                    <img src="data:image/jpg;base64,{{base64_encode($img)}}" alt="..." class="img-thumbnail">
                </div>
            @endforeach
            </div>

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
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($donation->funds as $fund)
                        <tr>
                            <td>{{$fund->donatorName}}</td>
                            <td>{{$fund->donatorMobile}}</td>
                            <td>{{$fund->donatorEmail}}</td>
                            <td>{{date("d M Y",strtotime($fund->donatedAt))}}</td>
                            <td>@if($fund->isAppUser) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                            <td>@if($fund->isIndividual) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                            <td>{{$fund->donatedAmount}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No data available</td>
                        </tr>
                    @endforelse
                        <tr>
                            <td colspan="6" class="text-right">Total Amount :</td>
                            <td>{{$donation->collectedAmount}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($donation->patientProfile)
    <div class="row">
        <div class="col-md-4 table-responsive">
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
                    <td>{{$donation->patientProfile->profession}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{$donation->patientProfile->address}}</td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td>{{$donation->patientProfile->area}}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{$donation->patientProfile->city}}</td>
                </tr>
                <tr>
                    <td>Contact Info</td>
                    <td>{{$donation->patientProfile->contactInfo}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8 table-responsive">
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

    <div class="row">
        @if($donation->patientProfile->seekingRaisedByDoctorProfile)
        <div class="col-md-4 table-responsive">
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

        @if($donation->patientProfile->currentDoctorProfile)
            <div class="col-md-4 table-responsive">
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

        @if($donation->patientProfile->paymentInfo)
            <div class="col-md-4 table-responsive">
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
    @endif

@endsection