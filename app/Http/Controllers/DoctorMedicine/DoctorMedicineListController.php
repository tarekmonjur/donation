<?php

namespace App\Http\Controllers\DoctorMedicine;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorMedicineListController extends Controller
{
    protected $httpClient;

    protected $auth;

    public function __construct(DoctorMedicineApiController $httpClient)
    {
        $this->middleware('auth');

        $this->httpClient = $httpClient;

        $this->middleware(function($request, $next){
            $this->auth = session()->get('auth');
            return $next($request);
        });
    }


    public function getDoctorList(Request $request)
    {
        $data['doctors'] = [];
//        $doctors = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/all','POST', []);
//
//        if($doctors->success == true) {
//            $data['doctors'] = ($doctors->data)?:[];
//        }
        return view('list.doctor_list')->with($data);
    }


    public function getMedicineList(Request $request)
    {
        $data['medicines'] = [];
//        $doctors = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/all','POST', []);
//
//        if($doctors->success == true) {
//            $data['doctors'] = ($doctors->data)?:[];
//        }
        return view('list.medicine_list')->with($data);
    }
}
