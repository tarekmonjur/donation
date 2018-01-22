<?php

namespace App\Http\Controllers\Coupon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAccountController extends Controller
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

        $data['accounts'] = [];
        $accounts = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'company-account/all','POST', []);

        if($accounts->success == true) {
            $data['accounts'] = ($accounts->data)?:[];
        }
        return view('coupon.company_account')->with($data);
    }


    public function changeStatus(Request $request)
    {
        if(!$this->auth->user_type == "admin"){
            return redirect()->back();
        }

        $param = [
            'accountNumber' =>  [$request->account_number],
            'accountStatus' =>  ($request->status == 1 || $request->status == '1')?true:false,
        ];

        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'company-account/change-status','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', $result->msg);
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


    public function show(Request $request)
    {

        if(!$this->auth->user_type != "admin"){
            if(intval($this->auth->company_id) != intval($request->companyId)) {
                return redirect()->back();
            }
        }

        $param = [
            'companyId' => $request->companyId,
            'companyAccountNumber' => $request->accountNumber
        ];

        $data['account'] = [];
        $account = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'company-account/details','POST', $param);

        if($account->success == true) {
            $data['account'] = ($account->data)?:[];
        }

        if(empty($data['account'])){
            return redirect()->back();
        }

        $onHoldTxIds = isset($data['account']->onHoldTxIds)?:[];
        $withdrawTxIds = isset($data['account']->withdrawTxIds)?:[];
        $depositTxIds = isset($data['account']->depositTxIds)?:[];

        $data['txData'] = array_merge($onHoldTxIds, $withdrawTxIds, $depositTxIds);

        return view('coupon.account_view')->with($data);
    }


    public function deposit(Request $request)
    {
        $param = [
            'accountNumber' =>  $request->accountNumber,
            'code' =>  $request->code,
            'serial' =>  $request->serial,
        ];

        $result = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'company-account/deposit','POST', $param);

        if($result->success === true){
            $request->session()->flash('msg_success', $result->msg);
        }else{
            $request->session()->flash('msg_error', $result->msg);
        }
        return redirect()->back();
    }


}
