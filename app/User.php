<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile' , 'Djv_Group' , 'Djv_Access' , 'title','user_pp','employee_code','username','chat_flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function complains()
    {
        return $this->hasMany(complain::class);
    }

    public function balances()
    {
        return $this->hasMany(employee_balance::class);
    }

    public function notes()
    {
        return $this->hasMany(employee_note::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'from');
    }


}
