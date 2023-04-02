<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'userId';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'isAdmin',
        'email',
        'password',
        'userPhoto'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isAdmin' => 'boolean'
    ];

    public function services(){
        return $this->belongsToMany(Service::class, 'userservicerequest', 'userId', 'serviceId');
    }

    public function events(){
        return $this->belongsToMany(Event::class, 'usereventrequest', 'userId', 'eventId');
    }

    public function eventOrganics(){
        return $this->belongsToMany(Event::class, 'usereventorganic', 'userId', 'eventId')
            ->withPivot('organicUnitId');
    }

    public function serviceOrganics(){
        return $this->belongsToMany(Service::class, 'userserviceorganic', 'userId', 'serviceId')
            ->withPivot('organicUnitId');
    }

}
