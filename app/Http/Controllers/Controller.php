<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Afcsm\SmApiController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function companyList(){
        $httpClient = new SmApiController;
        $result = $httpClient->sendRequest('GET','get-company-list');
        return $result->data;
    }
}
