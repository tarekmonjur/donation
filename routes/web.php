<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| @Description : Application All Routes without api.
| @Author : IDDL.
| @Email  : tarekmonjur@gmail.com
|
*/

Route::get('/','DashboardController');


///*
//* Users Login-Logout Routes
//*/
//Route::get('login','Auth\LoginController@showLogin')->name('login');
//Route::post('login','Auth\LoginController@login');
//Route::get('logout','Auth\LoginController@logout');
//
//
///*
// * Forgot & Reset Password Route
// */
//Route::group(['prefix' => 'password'],function(){
//    Route::get('forgot','Auth\ForgotPasswordController@showMailSend');
//    Route::post('sendmail','Auth\ForgotPasswordController@sendMail');
//    Route::get('reset/{token}/{email}','Auth\ResetPasswordController@showResetPassword');
//    Route::post('reset','Auth\ResetPasswordController@resetPassword');
//});



Route::group(['middleware' => 'guest'],function(){
    Route::get('/login', 'Afcsm\AuthController@showLogin');
    Route::post('/login', 'Afcsm\AuthController@login');
});




Route::group(['prefix'=>'donations'],function(){
    Route::get('/','Donation\DonationController@index');
    Route::get('/verify/{id}/{status}','Donation\DonationController@verifyDonation');
    Route::get('/add','Donation\DonationController@create');
    Route::get('/{id}','Donation\DonationController@show');
    Route::get('/fund-verify/{donation_id}/{fund_id}/{status}','Donation\DonationController@verifyFund');
    Route::get('/medical-records-doc/{id}','Donation\DonationController@getMedicalRecordDoc');

    Route::get('/edit/{id}','Donation\DonationController@edit');
    Route::post('/edit','Donation\DonationController@update');
});

Route::get('/logs','DashboardController@logs');


Route::group(['namespace'=>'Afcsm','middleware' => 'auth'],function(){
    Route::get('/logout', 'AuthController@logout');
    Route::get('/mr-list', 'SmController@index');
    Route::get('/mr-verify/{experience_id}/{mobile_no}', 'SmController@mrVerify');
    Route::get('/my-mr', 'SmController@myMrList');
    Route::get('/mr-doctor/{mr_mobile_no}/{api_token}', 'SmController@mrDoctorList');
    Route::get('/mr-assistant/{mr_mobile_no}/{api_token}', 'SmController@mrAssistantList');
    Route::get('/mr-doctor-visit-history/{mr_mobile_no}/{doctor_mobile_no}/{api_token}', 'SmController@mrDoctorVisitHistory');
    Route::get('/mr-doctor-visit-history-search', 'SmController@mrDoctorVisitHistorySearch');
    Route::get('/mr-coupons-details/{mr_mobile_no}/{api_token}', 'SmController@mrCouponsDetails');
});






















