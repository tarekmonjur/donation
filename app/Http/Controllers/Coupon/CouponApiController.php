<?php

namespace App\Http\Controllers\Coupon;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponApiController extends Controller
{
    protected  $client;

    public $apiUrl;


    public function __construct()
    {
        $this->client = new Client(['cookies' => true, 'verify' => false]);

        if(env('DOCTOR_API_MODE') == 0) {
            $this->apiUrl = "https://103.23.41.189:3000/api/admin/v1/";
        }
        elseif(env('DOCTOR_API_MODE') == 1)
        {
            $this->apiUrl = "https://localhost:5959/api/admin/v1/";
        }

    }


    public function sendRequest($url, $method = 'GET', $query=[])
    {
        $result = $this->client->request($method, $url, [
            'query' => $query,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);
        return $data;
    }


    public function sendRequestJson($url, $method = 'GET', $query=[], $contentType = "application/json")
    {
        $result = $this->client->request($method, $url, [
            'json' => $query,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => $contentType,
                'Content-Type' => $contentType,
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);
        return $data;
    }


}
