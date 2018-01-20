<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    protected $httpClient;

    protected $auth;

    public function __construct(DoctorApiController $httpClient)
    {
        $this->middleware('auth');

        $this->httpClient = $httpClient;

        $this->middleware(function($request, $next){
            $this->auth = session()->get('auth');
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        if(!$this->auth->user_type == "admin" || !$this->auth->user_type == "company"){
            return redirect()->back();
        }

        $data['doctors'] = [];
        $doctors = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/all','POST', []);

        if($doctors->success == true) {
            $data['doctors'] = ($doctors->data)?:[];
        }
        return view('doctor.index')->with($data);
    }


    public function show(Request $request)
    {
        $data['doctor'] = [];
        $doctors = $this->httpClient->sendRequest($this->httpClient->apiUrl.'doctors-program/'.$request->doctorSupportSeekingId,'GET', []);

        if($doctors->success == true) {
            $data['doctor'] = ($doctors->data)?:[];
        }

        return view('doctor.show')->with($data);
    }


    public function verified(Request $request)
    {
        $param = [
            'doctorSupportSeekingId' =>  $request->doctorSupportSeekingId
        ];
        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/verified-by-admin','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', $result->msg);
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


    public function addFund(Request $request)
    {
        $companyList = collect($this->companyList());
        $company= $companyList->firstWhere('id',$this->auth->company_id);

        $param = [
            'doctorsProgramId' =>  $request->doctorSupportSeekingId,
            'fund' => [
                'donatorName' => $this->auth->full_name,
                'donatorCompany' => $company->company_name,
                'donatorMobile' => $this->auth->mobile_no,
                'donatorEmail' => $this->auth->email,
                'donatedAmount' => $request->amount,
                'donatedAt' => date('Y-m-d h:i:s'),
                'isAppUser' => false,
                'isIndividual' => false,
            ]
        ];

        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/fund/add','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', 'Fund successfully added.');
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


//    public function myRaised(Request $request)
//    {
//        $data['doctors'] = [];
//        $doctors = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/my-raised/'.$request->doctorId,'POST', '{}');
//
//        if($doctors->success == true) {
//            $data['doctors'] = ($doctors->data)?:[];
//        }
//        return view('doctor.show')->with($data);
//    }
//
//
//    public function pharmaApproval(Request $request)
//    {
//
//        $param = [
//            'doctorSupportSeekingId' =>  $request->doctorSupportSeekingId,
//            'supportedBy' => ['pharmaName' => $request->pharmaName]
//        ];
//        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/pharma-approval','POST', $param);
//
//        if($result->success === true){
//            $request->session()->flash('msg_success', $result->msg);
//        }else{
//            $request->session()->flash('msg_error', $result->msg);
//        }
//        return redirect()->back();
//    }
//
//
//    public function acceptByDoctor(Request $request)
//    {
//        $param = [
//            'doctorSupportSeekingId' =>  $request->doctorSupportSeekingId,
//            'doctorId' => $request->doctorId
//        ];
//        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/accept-by-doctor','POST', $param);
//
//        if($result->success === true){
//            $request->session()->flash('msg_success', $result->msg);
//        }else{
//            $request->session()->flash('msg_error', $result->msg);
//        }
//        return redirect()->back();
//    }
//
//
//    public function removeByDoctor(Request $request)
//    {
//        $param = [
//            'doctorSupportSeekingId' =>  $request->doctorSupportSeekingId,
//            'doctorId' => $request->doctorId
//        ];
//        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/remove-by-doctor','POST', $param);
//
//        if($result->success === true){
//            $request->session()->flash('msg_success', $result->msg);
//        }else{
//            $request->session()->flash('msg_error', $result->msg);
//        }
//        return redirect()->back();
//    }


}
