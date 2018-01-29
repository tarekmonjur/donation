<?php

namespace App\Http\Controllers\DoctorMedicine;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorMedicineApiController extends Controller
{
    protected  $client;

    public $apiUrl;


    public function __construct()
    {
        $this->client = new Client(['cookies' => true, 'verify' => false]);

        if(env('DOCTOR_API_MODE') == 0) {
            $this->apiUrl = "http://103.23.41.189:3000/api/doctors-support-seeking/v1/";
        }
        elseif(env('DOCTOR_API_MODE') == 1)
        {
            $this->apiUrl = "http://localhost:5959/api/doctors-support-seeking/v1/";
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


    public function sendRequestDoc($url, $method = 'POST', $donationDocs=[], $content_type = 'image/jpeg')
    {
        $result = $this->client->request($method, $url, [
            'allow_redirects' => false,
            'headers' => [
                'x-accept-content-type' => $content_type,
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
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        return $content;
    }

}
