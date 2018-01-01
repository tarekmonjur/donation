<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
     /*
     |--------------------------------------------------------------------------
     | Dashboard Controller
     |--------------------------------------------------------------------------
     |
     | @Description : Application Dashboard
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
        $this->middleware('permission')->except('__invoke');
        $this->httpClient = $httpClient;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('dashboard');
    }

    public function logs()
    {
        $data['logs'] = [];
//        $logs = $this->httpClient->sendRequest($this->httpClient->apiUrl.'donation/all','POST', []);
//        if($logs->success == true) {
//            $data['logs'] = ($logs->data)?:[];
//        }
        return view('logs')->with($data);
    }


}
