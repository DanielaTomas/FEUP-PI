<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganicUnit extends Model
{
    protected $table = 'organicunit';

    protected $primaryKey = 'organicUnitId';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function events(){
        return $this->belongsToMany(Event::class, 'usereventorganic', 'organicUnitId', 'eventId')
            ->withPivot('userId');
    }

    public function services(){
        return $this->belongsToMany(Service::class, 'userserviceorganic', 'organicUnitId', 'serviceId')
            ->withPivot('userId');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'usereventorganic', 'organicUnitId', 'userId')
            ->withPivot('eventId');
    }

}