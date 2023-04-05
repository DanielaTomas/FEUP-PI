<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganicUnit extends Model
{
    protected $table = 'organicunit';

    protected $primaryKey = 'organicunitid';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function events(){
        return $this->belongsToMany(Event::class, 'usereventorganic', 'organicunitid', 'eventid')
            ->withPivot('userid');
    }

    public function services(){
        return $this->belongsToMany(Service::class, 'userserviceorganic', 'organicunitid', 'serviceid')
            ->withPivot('userid');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'usereventorganic', 'organicunitid', 'userid')
            ->withPivot('eventid');
    }

}