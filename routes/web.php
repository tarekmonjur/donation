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

    Route::get('/comment-delete/{userCommentId}','DonationController@removeComment');
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
    Route::get('/{doctorSupportSeekingId}','DoctorController@show');
    Route::post('/fund-add','DoctorController@addFund');
    Route::get('/fund-status/{doctorsProgramId}/{fundId}/{status}','DoctorController@fundChangeStatus');
    Route::get('/verified/{doctorSupportSeekingId}','DoctorController@verifiedProgram');
});


//Coupon Manage Route
Route::group(['prefix'=>'coupon-manager', 'namespace' => 'Coupon'],function(){
    Route::get('/','CouponManagerController@index');
    Route::post('/create','CouponManagerController@createCoupon');
    Route::get('/change-status/{coupon_id}/{status}','CouponManagerController@changeStatus');
    Route::post('/update','CouponManagerController@updateCoupon');
});

Route::group(['prefix'=>'company-account', 'namespace' => 'Coupon'],function(){
    Route::get('/','CompanyAccountController@index');
    Route::post('/deposit','CompanyAccountController@deposit');
    Route::get('/change-status/{account_number}/{status}','CompanyAccountController@changeStatus');
    Route::get('/{accountNumber}/{companyId}','CompanyAccountController@show');
});






















