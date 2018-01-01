<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname','email', 'password','mobile_no','user_type','designation','photo','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }


    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }


    public function getLastNameAttribute($value){
        return ucfirst($value);
    }


    public function getFullNameAttribute(){
        return ucfirst($this->firstname).' '.ucfirst($this->lastname);
    }


    public function getFullPhotoAttribute(){
        return asset('/images/user/'.$this->photo);
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('M d Y');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role', 'user_type', 'id');
    }

}
