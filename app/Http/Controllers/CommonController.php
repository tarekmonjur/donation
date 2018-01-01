<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    protected  $client;

    public $apiUrl;


    public function __construct()
    {
        $this->client = new Client(['cookies' => true, 'verify' => false]);

        if(env('API_MODE') == 0) {
            $this->apiUrl = "https://localhost:3000/api/admin/v1/";
        }
        elseif(env('API_MODE') == 1)
        {
            $this->apiUrl = "https://localhost:3000/api/admin/v1/";
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
                'x-auth-token'  => 'YAlx',
                'x-auth-user-id' => 'userId'
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);
        return $data;
    }


    public function sendRequestJson($url, $method = 'GET', $query=[])
    {
        $result = $this->client->request($method, $url, [
            'json' => $query,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json',
                'x-auth-token'  => 'YAlx',
                'x-auth-user-id' => 'userId'
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);
        return $data;
    }


    public function sendRequestDoc($url, $method = 'POST', $donationDocs=[], $content_type = 'image/jpeg')
    {
        $result = $this->client->request($method, $url, [
            'allow_redirects' => false,
            'headers' => [
                'x-accept-content-type' => $content_type,
                'x-auth-token'  => 'YAlx',
                'x-auth-user-id' => 'userId'
            ],
            'multipart' => $donationDocs
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);
        return $data;
    }
    
    public function sendMedicalDocRetriveRequest($url, $method = 'POST', $donationDocs=[], $content_type = 'image/jpeg')
    {
        $result = $this->client->request($method, $url, [
            'allow_redirects' => false,
            'headers' => [
                'x-accept-content-type' => $content_type,
                'x-auth-token'  => 'YAlx',
                'x-auth-user-id' => '01759239067'
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        return $content;
    }


}
