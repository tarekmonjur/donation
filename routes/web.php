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



//Donation Route
Route::group(['prefix'=>'donations', 'namespace' => 'Donation'],function(){
    Route::get('/','DonationController@index');
    Route::get('/verify/{id}/{status}','DonationController@verifyDonation');
    Route::get('/add','DonationController@create');
    Route::get('/{id}','DonationController@show');
    Route::get('/fund-verify/{donation_id}/{fund_id}/{status}','DonationController@verifyFund');
    Route::get('/medical-records-doc/{id}','DonationController@getMedicalRecordDoc');

    Route::get('/edit/{id}','DonationController@edit');
    Route::post('/edit','DonationController@update');
});

Route::get('/logs','DashboardController@logs');



//AFCSM Rouete
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


//Doctor Route
Route::group(['prefix'=>'doctors-program', 'namespace' => 'Doctor'],function(){
    Route::get('/','DoctorController@index');
});






















