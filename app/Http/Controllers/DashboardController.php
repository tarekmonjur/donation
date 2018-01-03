<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Psr7\build_query;
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

    public function logs(Request $request)
    {
        $data['logs'] = [];
        $query['from'] = $startDate = ($request->from)?date("Y-m-d", strtotime($request->from)):date("Y-m-d");
        $query['to'] = $endDate = ($request->to)?date("Y-m-d", strtotime($request->to)):date("Y-m-d");
        $limit = ($request->limit)?$request->limit + 1:11;
        $query['limit'] = $limit -1;
        $page = ($request->page)?:1;
        $skip = ($page - 1) * $limit;

        $logs = $this->httpClient->sendRequestJson($this->httpClient->apiUrl.'system-log/all','POST', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'limit' => $limit,
            'skip' => $skip
        ]);
        if($logs->success == true) {
            $logs = ($logs->data->logs)?:[];

            if(count($logs) > $limit - 1) {
                unset($logs[$limit -1]);
                $query['page'] = $page + 1;
                $data['next_link'] = build_query($query);
            }

            if($page > 1){
                $query['page'] = $page -1;
                $data['previous_link'] = build_query($query);
            }

            $data['logs'] = $logs;
        }

        return view('logs',$query)->with($data);
    }


}
