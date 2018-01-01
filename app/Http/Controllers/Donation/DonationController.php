<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Donation Controller
     |--------------------------------------------------------------------------
     |
     | @Description : Application Donation
     | @Author : IDDL.
     | @Email  : tarekmonjur@gmail.com
     |
     */

    protected $httpClient;

    /**
     * DashboardController constructor.
     * @param CommonController $httpClient
     */
    public function __construct(CommonController $httpClient){
        $this->middleware('auth');
        $this->middleware('permission');
        $this->httpClient = $httpClient;
    }

    public function index()
    {
        $data['donations'] = [];
        $donations = $this->httpClient->sendRequest($this->httpClient->apiUrl.'donation/all','POST', []);
        if($donations->success == true) {
            $data['donations'] = ($donations->data->donatePrograms)?:[];
        }
        return view('donation.index')->with($data);
    }


    public function create()
    {
        return view('donation.add');
    }


    public function verifyDonation(Request $request)
    {
        $donation = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'donation/verify','POST', [
            "donationProgramId" => $request->id,
            "verificationStatus" => ($request->status == 1 || $request->status == '1')?true:false
        ]);
        if($donation->success == true) {
            $request->session()->flash("msg_success", $donation->msg);
        }else{
            $request->session()->flash("msg_error", $donation->msg);
        }
        return redirect()->back();
    }


    public function show($id)
    {

        $donation = $this->httpClient->sendRequest($this->httpClient->apiUrl.'donation/'.$id,'GET', []);
        if($donation->success == true && $donation->data->donatePrograms) {
            $data['donation'] = $donation->data->donatePrograms;
        }else{
            return redirect('/donations');
        }
        return view('donation.show')->with($data);
    }


    public function edit($id)
    {
        $donation = $this->httpClient->sendRequest($this->httpClient->apiUrl.'donation/'.$id,'GET', []);
        if($donation->success == true && $donation->data->donatePrograms) {
            $data['donation'] = $donation->data->donatePrograms;
        }else{
            return redirect('/donations');
        }
        return view('donation.edit')->with($data);
    }


    public function update(Request $request)
    {
        $donationUpdate = [
            "donationProgramId" => $request->id,
            "title" => $request->title,
            "diseaseTypeTag" => json_decode($request->diseaseTypeTag),
            "diseaseStage" => $request->diseaseStage,
            "sufferingFrom" => $request->sufferingFrom,
            "diseaseHistory" => $request->diseaseHistory,
            "targetAmount" => $request->targetAmount,
            "targetDate" => $request->targetDate,
            "collectedAmount" => $request->collectedAmount,
            "activeProgram" => $request->activeProgram,
            "patientProfile" => [
                "name" => $request->name,
                "age" => $request->age,
                "profession" => $request->profession,
                "gender" => $request->gender,
                "contactInfo" => $request->contactInfo,
                "address" => $request->address,
                "area" => $request->area,
                "city" => $request->city,
                "seekingRaisedByDoctorProfile" => [
                    "id" => $request->seekingId,
                    "name" => $request->seekingName,
                    "hospital" => $request->seekingHospital,
                    "chamber" => $request->seekingChamber,
                    "Designation" => $request->seekingDesignation,
                    "Speciality" => $request->seekingSpeciality,
                ],
                "paymentInfo" => [
                    "paymentType" => $request->paymentType,
                    "bankName" => $request->bankName,
                    "bankBranch" => $request->bankBranch,
                    "accountNumber" => $request->accountNumber,
                ]
            ]
        ];

        if($request->has('doctorName')){
            $donationUpdate['patientProfile']['currentDoctorProfile'] =  [
                "id" => $request->id,
                "name" => $request->doctorName,
                "hospital" => $request->hospital,
                "chamber" => $request->chamber,
                "Designation" => $request->Designation,
                "Speciality" => $request->Speciality,
            ];
        }

        $donation = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'donation/update-data','POST', $donationUpdate);
        if($donation->success == true) {
            $request->session()->flash('msg_success', $donation->msg);
        }else{
            $request->session()->flash('msg_error', $donation->msg);
        }
        

        if($request->hasFile('docs')) {
            $donationDocs = [];
            if (is_array($request->docs)) {
                foreach ($request->docs as $key => $val) {
                    //$donationDoc["file_" . $key] = file_get_contents($val->getRealPath());
                    $donationDocs[] = [
                        "name" => "file_" . $key,
                        "contents" => file_get_contents($val->getRealPath()),
                        "filename" => $val->getClientOriginalName()
                    ];
                }
            }

            $donationDocs[]=["name" => "donationProgramId",  "contents"=> $request->id];
            //dd($donationDocs);
            
            $res = $this->httpClient->sendRequestDoc($this->httpClient->apiUrl . 'donation/medical-records/add', 'POST', $donationDocs, "multipart/form-data");
            if ($res->success == true) {
                $request->session()->flash('msg_success', $res->msg);
            } else {
                $request->session()->flash('msg_error', $res->msg);
            }
        }

//        dd($donationUpdate, json_encode($donationUpdate));
        return redirect()->back();

    }



}
