<?php

namespace App\Http\Controllers\Afcsm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $httpClient;

    protected $auth;

    public function __construct(SmApiController $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $attempt = $this->httpClient->sendAuthRequest('POST','login', [
            'mobile_no' => $request->mobile_no,
            'password'  => $request->password,
            'user_type' => 'notmr'
        ]);

        if($attempt->code == 200){
            session()->put('api-token', $attempt->data->{'api-token'});
            session()->put('auth', $attempt->data);
            return redirect('/');
        }else{
//            dd($attempt);
            $request->session()->flash('msg_error', $attempt->message);
            return redirect('/login')->withInput()->withErrors($attempt->data);
        }
    }


    public function logout(Request $request)
    {
        $logout = $this->httpClient->sendAuthRequest('GET','logout');
        if(isset($logout->code) && ($logout->code == 200 || $logout->code == 401)){
            $request->session()->flush();
        }
        return redirect('/');

    }

}
