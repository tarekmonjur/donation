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
        $data['doctors'] = [];
        $doctors = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'doctors-program/all','POST', []);

        if($doctors->success == true) {
            $data['doctors'] = ($doctors->data)?:[];
        }
        return view('doctor.index')->with($data);
    }

}
