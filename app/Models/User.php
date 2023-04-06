<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'userid';

    public $timestamps = false;
    protected $username = 'username';
    protected $fillable = [
        'username',
        'isadmin',
        'email',
        'password',
        'userphoto'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isadmin' => 'boolean'
    ];

    public function services(){
        return $this->belongsToMany(Service::class, 'userservicerequest', 'userid', 'serviceid');
    }

    public function events(){
        return $this->belongsToMany(Event::class, 'usereventrequest', 'userid', 'eventid');
    }

    public function eventOrganics(){
        return $this->belongsToMany(Event::class, 'usereventorganic', 'userid', 'eventid')
            ->withPivot('organicunitid');
    }

    public function serviceOrganics(){
        return $this->belongsToMany(Service::class, 'userserviceorganic', 'userid', 'serviceid')
            ->withPivot('organicunitid');
    }

}
