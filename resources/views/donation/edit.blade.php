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

    <h4>Edit Donation</h4>
    <div class="row">
        <div class="col-md-12">
            <form id="donation_form" method="post" action="{{url('donations/edit')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" value="{{$donation->_id}}" name="id">
                <input type="hidden" value="{{$donation->title}}" name="title">
                <input type="hidden" value="{{json_encode($donation->diseaseTypeTag)}}" name="diseaseTypeTag">
                <input type="hidden" value="{{$donation->diseaseStage}}" name="diseaseStage">
                <input type="hidden" value="{{$donation->sufferingFrom}}" name="sufferingFrom">
                <input type="hidden" value="{{$donation->targetAmount}}" name="targetAmount">
                <input type="hidden" value="{{$donation->targetDate}}" name="targetDate">
                <input type="hidden" value="{{$donation->collectedAmount or '0'}}" name="collectedAmount">
                <input type="hidden" value="{{($donation->activeProgram)?'true':'false'}}" name="activeProgram">

                <div class="form-row border p-2 box_shadow">
                    <div class="form-group col-md-12">
                        <label for="diseaseHistory">Disease History</label>
                        <textarea name="diseaseHistory" class="form-control" rows="5" id="diseaseHistory" placeholder="Enter disease history">{{$donation->diseaseHistory or 'No disease history...'}}</textarea>
                    </div>
                </div>

                @if($donation->patientProfile)
                <h5 class="text-center pt-3">Patient Profile</h5>
                <div class="form-row border p-2 box_shadow">
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
                        <input type="text" class="form-control" id="profession" name="profession" value="{{$donation->patientProfile->profession or ''}}" placeholder="Enter profession">
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
                        <input type="text" class="form-control" id="contactInfo" name="contactInfo" value="{{$donation->patientProfile->contactInfo or ''}}" placeholder="Enter contact info">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Enter address">{{$donation->patientProfile->address or ''}}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="area">Area</label>
                        <input type="text" class="form-control" id="area" name="area" value="{{$donation->patientProfile->area or ''}}" placeholder="Enter area">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        @if(isset($donation->patientProfile->city))
                        <select name="city" id="city" class="form-control">
                             <option value="Bandarban" @if($donation->patientProfile->city == 'Bandarban') selected @endif>Bandarban</option>
                             <option value="Barguna" @if($donation->patientProfile->city == 'Barguna') selected @endif>Barguna</option>
                             <option value="Barisal" @if($donation->patientProfile->city == 'Barisal') selected @endif>Barisal</option>
                             <option value="Bhola" @if($donation->patientProfile->city == 'Bhola') selected @endif>Bhola</option>
                             <option value="Bogra" @if($donation->patientProfile->city == 'Bogra') selected @endif>Bogra</option>
                             <option value="Brahmanbaria" @if($donation->patientProfile->city == 'Brahmanbaria') selected @endif>Brahmanbaria</option>
                             <option value="Chandpur" @if($donation->patientProfile->city == 'Chandpur') selected @endif>Chandpur</option>
                             <option value="Chapainababganj" @if($donation->patientProfile->city == 'Chapainababganj') selected @endif>Chapainababganj</option>
                             <option value="Chittagong" @if($donation->patientProfile->city == 'Chittagong') selected @endif>Chittagong</option>
                             <option value="Chuadanga" @if($donation->patientProfile->city == 'Chuadanga') selected @endif>Chuadanga</option>
                             <option value="Comilla" @if($donation->patientProfile->city == 'Comilla') selected @endif>Comilla</option>
                             <option value="Coxs bazar" @if($donation->patientProfile->city == 'Coxs bazar') selected @endif>Cox's bazar</option>
                             <option value="Dhaka" @if($donation->patientProfile->city == 'Dhaka') selected @endif>Dhaka</option>
                             <option value="Dinajpur" @if($donation->patientProfile->city == 'Dinajpur') selected @endif>Dinajpur</option>
                             <option value="Faridpur" @if($donation->patientProfile->city == 'Faridpur') selected @endif>Faridpur</option>
                             <option value="Feni" @if($donation->patientProfile->city == 'Feni') selected @endif>Feni</option>
                             <option value="Gaibandha" @if($donation->patientProfile->city == 'Gaibandha') selected @endif>Gaibandha</option>
                             <option value="Gazipur" @if($donation->patientProfile->city == 'Gazipur') selected @endif>Gazipur</option>
                             <option value="Gopalganj" @if($donation->patientProfile->city == 'Gopalganj') selected @endif>Gopalganj</option>
                             <option value="Habiganj" @if($donation->patientProfile->city == 'Habiganj') selected @endif>Habiganj</option>
                             <option value="Jamalpur" @if($donation->patientProfile->city == 'Jamalpur') selected @endif>Jamalpur</option>
                             <option value="Jessore" @if($donation->patientProfile->city == 'Jessore') selected @endif>Jessore</option>
                             <option value="Jhalokati" @if($donation->patientProfile->city == 'Jhalokati') selected @endif>Jhalokati</option>
                             <option value="Jhenaidah" @if($donation->patientProfile->city == 'Jhenaidah') selected @endif>Jhenaidah</option>
                             <option value="Joypurhat" @if($donation->patientProfile->city == 'Joypurhat') selected @endif>Joypurhat</option>
                             <option value="Khagrachhari" @if($donation->patientProfile->city == 'Khagrachhari') selected @endif>Khagrachhari</option>
                             <option value="Khulna" @if($donation->patientProfile->city == 'Khulna') selected @endif>Khulna</option>
                             <option value="Kishoregonj" @if($donation->patientProfile->city == 'Kishoregonj') selected @endif>Kishoregonj</option>
                             <option value="Kurigram" @if($donation->patientProfile->city == 'Kurigram') selected @endif>Kurigram</option>
                             <option value="Kushtia" @if($donation->patientProfile->city == 'Kushtia') selected @endif>Kushtia</option>
                             <option value="Lakshmipur" @if($donation->patientProfile->city == 'Lakshmipur') selected @endif>Lakshmipur</option>
                             <option value="Lalmonirhat" @if($donation->patientProfile->city == 'Lalmonirhat') selected @endif>Lalmonirhat</option>
                             <option value="Madaripur" @if($donation->patientProfile->city == 'Madaripur') selected @endif>Madaripur</option>
                             <option value="Magura" @if($donation->patientProfile->city == 'Magura') selected @endif>Magura</option>
                             <option value="Manikganj" @if($donation->patientProfile->city == 'Manikganj') selected @endif>Manikganj</option>
                             <option value="Maulvibazar" @if($donation->patientProfile->city == 'Maulvibazar') selected @endif>Maulvibazar</option>
                             <option value="Meherpur" @if($donation->patientProfile->city == 'Meherpur') selected @endif>Meherpur</option>
                             <option value="Munshiganj" @if($donation->patientProfile->city == 'Munshiganj') selected @endif>Munshiganj</option>
                             <option value="Mymensingh" @if($donation->patientProfile->city == 'Mymensingh') selected @endif>Mymensingh</option>
                             <option value="Naogaon" @if($donation->patientProfile->city == 'Naogaon') selected @endif>Naogaon</option>
                             <option value="Narail" @if($donation->patientProfile->city == 'Narail') selected @endif>Narail</option>
                             <option value="Narayanganj" @if($donation->patientProfile->city == 'Narayanganj') selected @endif>Narayanganj</option>
                             <option value="Narsingdi" @if($donation->patientProfile->city == 'Narsingdi') selected @endif>Narsingdi</option>
                             <option value="Natore" @if($donation->patientProfile->city == 'Natore') selected @endif>Natore</option>
                             <option value="Netrakona" @if($donation->patientProfile->city == 'Netrakona') selected @endif>Netrakona</option>
                             <option value="Nilphamari" @if($donation->patientProfile->city == 'Nilphamari') selected @endif>Nilphamari</option>
                             <option value="Noakhali" @if($donation->patientProfile->city == 'Noakhali') selected @endif>Noakhali</option>
                             <option value="Pabna" @if($donation->patientProfile->city == 'Pabna') selected @endif>Pabna</option>
                             <option value="Panchagarh" @if($donation->patientProfile->city == 'Panchagarh') selected @endif>Panchagarh</option>
                             <option value="Patuakhali" @if($donation->patientProfile->city == 'Patuakhali') selected @endif>Patuakhali</option>
                             <option value="Pirojpur" @if($donation->patientProfile->city == 'Pirojpur') selected @endif>Pirojpur</option>
                             <option value="Rajbari" @if($donation->patientProfile->city == 'Rajbari') selected @endif>Rajbari</option>
                             <option value="Rajshahi" @if($donation->patientProfile->city == 'Rajshahi') selected @endif>Rajshahi</option>
                             <option value="Rangamati" @if($donation->patientProfile->city == 'Rangamati') selected @endif>Rangamati</option>
                             <option value="Rangpur" @if($donation->patientProfile->city == 'Rangpur') selected @endif>Rangpur</option>
                             <option value="Satkhira" @if($donation->patientProfile->city == 'Satkhira') selected @endif>Satkhira</option>
                             <option value="Shariatpur" @if($donation->patientProfile->city == 'Shariatpur') selected @endif>Shariatpur</option>
                             <option value="Sherpur" @if($donation->patientProfile->city == 'Sherpur') selected @endif>Sherpur</option>
                             <option value="Sirajganj" @if($donation->patientProfile->city == 'Sirajganj') selected @endif>Sirajganj</option>
                             <option value="Sunamganj" @if($donation->patientProfile->city == 'Sunamganj') selected @endif>Sunamganj</option>
                             <option value="Sylhet" @if($donation->patientProfile->city == 'Sylhet') selected @endif>Sylhet</option>
                             <option value="Tangail" @if($donation->patientProfile->city == 'Tangail') selected @endif>Tangail</option>
                             <option value="Thakurgaon" @if($donation->patientProfile->city == 'Thakurgaon') selected @endif>Thakurgaon</option>
                        </select>
                        @else
                        <input type="text" class="form-control" id="city" name="city" value="{{$donation->patientProfile->city or ''}}" placeholder="Enter city">
                        @endif
                    </div>
                </div>
                @endif

                @if($donation->docs)
                    <h5 class="text-center pt-3">Documents</h5>
                    <div class="form-row border p-2 box_shadow" id="docs">
                        @foreach($donation->docs as $doc)
                            <script> callDocs('{{$doc->_id}}'); </script>
                        @endforeach
                    </div>
                @endif

                <div class="form-row border p-2 box_shadow">
                    <div class="form-group col-md-4">
                        <label for="docs">Upload Document</label>
                        <input type="file" class="form-control" id="docs" name="docs[]" accept="image/*" multiple>
                    </div>
                </div>

                @if(isset($donation->patientProfile->paymentInfo))
                    <h5 class="text-center pt-3">Payment Info</h5>
                    <div class="form-row border p-2 box_shadow">
                        <div class="form-group col-md-6">
                            <label for="paymentType">Payment Type</label>
                            <select name="paymentType" id="paymentType" class="form-control">
                                <option value="bank transfer" @if($donation->patientProfile->paymentInfo->paymentType == "bank transfer") selected @endif>Bank Transfer</option>
                                <option value="cash" @if($donation->patientProfile->paymentInfo->paymentType == "cash") selected @endif>Cash</option>
                            </select>
                            {{--<input type="text" class="form-control" id="paymentType" name="paymentType" value="{{$donation->patientProfile->paymentInfo->paymentType}}" placeholder="Enter payment type">--}}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bankName">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" name="bankName" value="{{$donation->patientProfile->paymentInfo->bankName}}" placeholder="Enter bank name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bankBranch">Bank Branch</label>
                            <input type="text" class="form-control" id="bankBranch" name="bankBranch" value="{{$donation->patientProfile->paymentInfo->bankBranch}}" placeholder="Enter Bank Branch">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" name="accountNumber" value="{{$donation->patientProfile->paymentInfo->accountNumber}}" placeholder="Enter account number">
                        </div>
                    </div>
                @else
                    <h5 class="text-center pt-3">Payment Info</h5>
                    <div class="form-row border p-2 box_shadow">
                        <div class="form-group col-md-6">
                            <label for="paymentType">Payment Type</label>
                            <input type="text" class="form-control" id="paymentType" name="paymentType" placeholder="Enter payment type">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bankName">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Enter bank name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bankBranch">bankBranch</label>
                            <input type="text" class="form-control" id="bankBranch" name="bankBranch" placeholder="Enter Bank Branch">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Enter account number">
                        </div>
                    </div>
                @endif

                @if(isset($donation->patientProfile->currentDoctorProfile))
                    <h5 class="text-center pt-3">Current Doctor Profile</h5>
                    <div class="form-row border p-2 box_shadow">
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
                    <div class="form-row border p-2 box_shadow">
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
                    <input type="hidden" class="form-control" id="seekingId" name="seekingId" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->id}}" placeholder="Enter id">
                    <input type="hidden" class="form-control" id="seekingName" name="seekingName" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->name}}" placeholder="Enter name">
                    <input type="hidden" class="form-control" id="seekingHospital" name="seekingHospital" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->hospital}}" placeholder="Enter hospital">
                    <input type="hidden" class="form-control" id="seekingChamber" name="seekingChamber" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->chamber}}" placeholder="Enter chamber">
                    <input type="hidden" class="form-control" id="seekingDesignation" name="seekingDesignation" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->Designation}}" placeholder="Enter designation">
                    <input type="hidden" class="form-control" id="seekingSpeciality" name="seekingSpeciality" value="{{$donation->patientProfile->seekingRaisedByDoctorProfile->Speciality}}" placeholder="Enter speciality">
                @else
                    <h5 class="text-center pt-3">Seeking Raised By Doctor Profile</h5>
                    <div class="form-row border p-2 box_shadow">
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


                <button type="submit" class="btn btn-primary pull-right mt-3 mb-5 ml-3" onclick="showLoading()">Update Donation</button>
                <a href="{{url('donations/'.$donation->_id)}}" class="btn btn-info pull-right mt-3 mb-5 ml-3">View Details</a>
            </form>
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