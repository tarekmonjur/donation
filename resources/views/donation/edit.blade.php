@extends('layouts.layout')
@section('content')
@inject('client', 'App\Http\Controllers\CommonController')

    <h4>Edit Donation</h4>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{url('donations/edit')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" value="{{$donation->_id}}" name="id">
                <input type="hidden" value="{{$donation->title}}" name="title">
                <input type="hidden" value="{{json_encode($donation->diseaseTypeTag)}}" name="diseaseTypeTag">
                <input type="hidden" value="{{$donation->diseaseStage}}" name="diseaseStage">
                <input type="hidden" value="{{$donation->sufferingFrom}}" name="sufferingFrom">
                <input type="hidden" value="{{$donation->targetAmount}}" name="targetAmount">
                <input type="hidden" value="{{$donation->targetDate}}" name="targetDate">
                <input type="hidden" value="{{$donation->collectedAmount}}" name="collectedAmount">
                <input type="hidden" value="{{($donation->activeProgram)?'true':'false'}}" name="activeProgram">

                <div class="form-row border p-2">
                    <div class="form-group col-md-12">
                        <label for="diseaseHistory">Disease History</label>
                        <textarea name="diseaseHistory" class="form-control" rows="5" id="diseaseHistory" placeholder="Enter disease history">{{$donation->diseaseHistory}}</textarea>
                    </div>
                </div>

                @if($donation->patientProfile)
                <h5 class="text-center pt-3">Patient Profile</h5>
                <div class="form-row border p-2">
                    <div class="form-group col-md-6">
                        <label for="name">Patient Name</label>
                        <input type="text" class="form-control" id="profession" name="name" value="{{$donation->patientProfile->name or ''}}" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" value="{{$donation->patientProfile->age or ''}}" placeholder="Enter age">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="profession">Profession</label>
                        <input type="text" class="form-control" id="profession" name="profession" value="{{$donation->patientProfile->profession}}" placeholder="Enter profession">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="male">Gender</label>
                        <br>
                        <label for="male">Male</label>
                        <input type="radio" id="male" name="gender" value="MALE" @if(isset($donation->patientProfile->gender) && $donation->patientProfile->gender == "MALE") checked @endif>
                        <label for="male">Female</label>
                        <input type="radio" id="female" name="gender" value="FEMALE" @if(isset($donation->patientProfile->gender) && $donation->patientProfile->gender == "FEMALE") checked @endif>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contactInfo">Contact Info</label>
                        <input type="text" class="form-control" id="contactInfo" name="contactInfo" value="{{$donation->patientProfile->contactInfo}}" placeholder="Enter contact info">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Enter address">{{$donation->patientProfile->address}}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="area">Area</label>
                        <input type="text" class="form-control" id="area" name="area" value="{{$donation->patientProfile->area}}" placeholder="Enter area">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$donation->patientProfile->city}}" placeholder="Enter city">
                    </div>
                </div>
                @endif

                @if($donation->docs)
                    <h5 class="text-center pt-3">Documents</h5>
                    <div class="form-row border p-2">
                        @foreach($donation->docs as $doc)
                            <div class="col-md-2 pt-1 pb-1">
                                <?php $img = $client->sendRequestDoc($client->apiUrl.'donation/medical-records/view/'.$doc->_id.'/1', 'GET'); ?>
                                <img src="data:image/jpg;base64,{{base64_encode($img)}}" alt="..." class="img-thumbnail">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="form-row border p-2">
                    <div class="form-group col-md-4">
                        <label for="docs">Upload Document</label>
                        <input type="file" class="form-control" id="docs" name="docs[]" multiple>
                    </div>
                </div>

                @if($donation->patientProfile->paymentInfo)
                <h5 class="text-center pt-3">Payment Info</h5>
                <div class="form-row border p-2">
                    <div class="form-group col-md-6">
                        <label for="paymentType">Payment Type</label>
                        <input type="text" class="form-control" id="paymentType" name="paymentType" value="{{$donation->patientProfile->paymentInfo->paymentType}}" placeholder="Enter payment type">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bankName">Bank Name</label>
                        <input type="text" class="form-control" id="bankName" name="bankName" value="{{$donation->patientProfile->paymentInfo->bankName}}" placeholder="Enter bank name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bankBranch">bankBranch</label>
                        <input type="text" class="form-control" id="bankBranch" name="bankBranch" value="{{$donation->patientProfile->paymentInfo->bankBranch}}" placeholder="Enter Bank Branch">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="accountNumber">Account Number</label>
                        <input type="text" class="form-control" id="accountNumber" name="accountNumber" value="{{$donation->patientProfile->paymentInfo->accountNumber}}" placeholder="Enter account number">
                    </div>
                </div>
                @endif

                @if($donation->patientProfile->currentDoctorProfile)
                    <h5 class="text-center pt-3">Current Doctor Profile</h5>
                    <div class="form-row border p-2">
                        <div class="form-group col-md-6">
                            <label for="name">Doctor Name</label>
                            <input type="text" class="form-control" id="name" readonly value="{{$donation->patientProfile->currentDoctorProfile->name}}" placeholder="Enter doctor name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hospital">Hospital</label>
                            <input type="text" class="form-control" id="hospital" readonly value="{{$donation->patientProfile->currentDoctorProfile->hospital}}" placeholder="Enter hospital">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chamber">Chamber</label>
                            <input type="text" class="form-control" id="chamber" readonly value="{{$donation->patientProfile->currentDoctorProfile->chamber}}" placeholder="Enter chamber">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Designation">Designation</label>
                            <input type="text" class="form-control" id="Designation" readonly value="{{$donation->patientProfile->currentDoctorProfile->Designation}}" placeholder="Enter designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Speciality">Speciality</label>
                            <input type="text" class="form-control" id="Speciality" readonly value="{{$donation->patientProfile->currentDoctorProfile->Speciality}}" placeholder="Enter speciality">
                        </div>
                    </div>
                @else
                    <h5 class="text-center pt-3">Current Doctor Profile</h5>
                    <div class="form-row border p-2">
                        <div class="form-group col-md-6">
                            <label for="name">Doctor Name</label>
                            <input type="text" class="form-control" id="doctorName" name="name" placeholder="Enter doctor name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hospital">Hospital</label>
                            <input type="text" class="form-control" id="hospital" name="hospital"  placeholder="Enter hospital">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chamber">Chamber</label>
                            <input type="text" class="form-control" id="chamber" name="chamber" placeholder="Enter chamber">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Designation">Designation</label>
                            <input type="text" class="form-control" id="Designation" name="Designation" placeholder="Enter designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Speciality">Speciality</label>
                            <input type="text" class="form-control" id="Speciality" name="Speciality" placeholder="Enter speciality">
                        </div>
                    </div>
                @endif

                @if(isset($donation->patientProfile->seekingRaisedByDoctorProfile))
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" id="seekingId" name="seekingId" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->id}}" placeholder="Enter id">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" id="seekingName" name="seekingName" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->name}}" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" id="seekingHospital" name="seekingHospital" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->hospital}}" placeholder="Enter hospital">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" id="seekingChamber" name="seekingChamber" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->chamber}}" placeholder="Enter chamber">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" id="seekingDesignation" name="seekingDesignation" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->Designation}}" placeholder="Enter designation">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" id="seekingSpeciality" name="seekingSpeciality" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->Speciality}}" placeholder="Enter speciality">
                        </div>
                @else
                    <h5 class="text-center pt-3">Seeking Raised By Doctor Profile</h5>
                    <div class="form-row border p-2">
                        <div class="form-group col-md-6">
                            <label for="seekingId">ID</label>
                            <input type="text" class="form-control" id="seekingId" name="seekingId" placeholder="Enter id">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seekingName"> Name</label>
                            <input type="text" class="form-control" id="seekingName" name="seekingName" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seekingHospital">Hospital</label>
                            <input type="text" class="form-control" id="seekingHospital" name="seekingHospital" placeholder="Enter hospital">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seekingChamber">Chamber</label>
                            <input type="text" class="form-control" id="seekingChamber" name="seekingChamber" placeholder="Enter chamber">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seekingDesignation">Designation</label>
                            <input type="text" class="form-control" id="seekingDesignation" name="seekingDesignation" placeholder="Enter designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seekingSpeciality">Speciality</label>
                            <input type="text" class="form-control" id="seekingSpeciality" name="seekingSpeciality" placeholder="Enter speciality">
                        </div>
                    </div>
                @endif


                <button type="submit" class="btn btn-primary mt-3 mb-5">Submit</button>
            </form>
        </div>
    </div>


@endsection