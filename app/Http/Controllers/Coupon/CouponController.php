<?php

namespace App\Http\Controllers\Coupon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    protected $httpClient;

    protected $auth;

    public function __construct(CouponApiController $httpClient)
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
        if(!$this->auth->user_type == "admin"){
            return redirect()->back();
        }

        $data['coupons'] = [];
        $doctors = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'coupon-manager/all','POST', []);

        if($doctors->success == true) {
            $data['coupons'] = ($doctors->data)?:[];
        }
        return view('coupon.coupon')->with($data);
    }



}
