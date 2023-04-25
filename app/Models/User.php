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

    public function services()
    {
        return $this->hasMany(Event::class, 'userid');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'userid');
    }

    public function organicUnits()
    {
        return $this->belongsToMany(OrganicUnit::class, 'formation', 'userid', 'organicunitid');
    }

    public function isAdmin()
    {
        return $this->isadmin;
    }
}
