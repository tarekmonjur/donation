<?php

namespace App\Providers;

use App\Models\User;
use App\Mail\UserSignup;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function($user){
            //Mail::to($user->email)->queue(new UserSignup($user));
        });
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
