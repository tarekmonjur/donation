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
        return view('coupon.index')->with($data);
    }


    public function createCoupon(Request $request)
    {
        if(!$this->auth->user_type == "admin"){
            return redirect()->back();
        }

        $param = [
            'totalCouponCount' =>  $request->coupon_no,
            'couponTitle' =>  $request->title,
            'couponInitAmount' =>  $request->amount,
        ];

        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'coupon-manager/create','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', $result->msg);
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


    public function changeStatus(Request $request)
    {
        if(!$this->auth->user_type == "admin"){
            return redirect()->back();
        }

        $param = [
            'couponIds' =>  [$request->coupon_id],
            'status' =>  ($request->status == 1 || $request->status == '1')?true:false,
        ];

        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'coupon-manager/change-status','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', $result->msg);
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


    public function updateCoupon(Request $request)
    {
        if(!$this->auth->user_type == "admin"){
            return redirect()->back();
        }

        $param = [
            'couponIds' =>  [$request->id],
            'amount' =>  $request->amount,
        ];

        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'coupon-manager/change-amount','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', $result->msg);
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


}
