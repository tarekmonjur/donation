<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $reports = $this->httpClient->sendRequest($this->httpClient->apiUrl.'report/dashboard','GET',[]);
        $data['byStatusSummary'] = $reports->byStatusSummary;

        $byFundCollectionAmountSummary = [
            [
                "name" => "Total Target Amount",
                "y" => $reports->byFundCollectionAmountSummary->totalTargetAmount
            ],
            [
                "name" => "Total Collected Amount",
                "y" => $reports->byFundCollectionAmountSummary->totalCollectedAmount
            ],
            [
                "name" => "Count",
                "y" => $reports->byFundCollectionAmountSummary->count
            ]
        ];
        $data['byFundCollectionAmountSummary'] = json_encode($byFundCollectionAmountSummary);

        if(intval($reports->byFundCollectionAmountSummary->count) <= 0){
            $data['chart_one'] = false;
        }else{
            $data['chart_one'] = true;
        }


        $byContributorTypeFundCollection = [
            [
                "name" => "Personal",
                "y" => $reports->byContributorTypeFundCollection->personal
            ],
            [
                "name" => "Company",
                "y" => $reports->byContributorTypeFundCollection->company
            ]
        ];
        $data['byContributorTypeFundCollection'] = json_encode($byContributorTypeFundCollection);

        if(intval($reports->byContributorTypeFundCollection->personal) <= 0 && intval($reports->byContributorTypeFundCollection->company) <= 0){
            $data['chart_two'] = false;
        }else{
            $data['chart_two'] = true;
        }


        $byStatusFundCollection = [
            [
                "name" => "Verified By Individual",
                "y" => $reports->byStatusFundCollection->verifiedByIndividual
            ],
            [
                "name" => "Unverified By Individual",
                "y" => $reports->byStatusFundCollection->unverifiedByIndividual
            ],
            [
                "name" => "Verified By Company",
                "y" => $reports->byStatusFundCollection->verifiedByCompany
            ],
            [
                "name" => "Unverified By Company",
                "y" => $reports->byStatusFundCollection->unverifiedByCompany
            ]
        ];
        $data['byStatusFundCollection'] = json_encode($byStatusFundCollection);

        if(intval($reports->byStatusFundCollection->verifiedByIndividual) <= 0 && intval($reports->byStatusFundCollection->unverifiedByIndividual) <= 0 && intval($reports->byStatusFundCollection->verifiedByCompany) <= 0 && intval($reports->byStatusFundCollection->unverifiedByCompany) <= 0){
            $data['chart_three'] = false;
        }else{
            $data['chart_three'] = true;
        }


        $byMonthFundCollection_year = [];
        $byMonthFundCollection_amount = [];
        foreach($reports->byMonthFundCollection as $byMonthFundCollection){
            $byMonthFundCollection_year[] = $byMonthFundCollection->yearMonth;
            $byMonthFundCollection_amount[] = $byMonthFundCollection->amount;
        }
        $data['byMonthFundCollection_year'] = json_encode($byMonthFundCollection_year);
        $data['byMonthFundCollection_amount'] = json_encode($byMonthFundCollection_amount);

        if(count($byMonthFundCollection_year) <= 0){
            $data['chart_four'] = false;
        }else{
            $data['chart_four'] = true;
        }

        return view('dashboard')->with($data);
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
                $data['next_link'] = http_build_query ($query);
            }

            if($page > 1){
                $query['page'] = $page -1;
                $data['previous_link'] = http_build_query ($query);
            }

            $data['logs'] = $logs;
        }

        return view('logs',$query)->with($data);
    }


}
