<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';

    protected $primaryKey = 'serviceId';

    public $timestamps = false;

    protected $fillable = [
        'serviceName',
        'requestStatus',
        'requestType',
        'purpose',
        'email',
        'contactPerson',
        'url',
        'version',
        'startDate',
        'endDate',
        'versionNumber',
        'serviceTypeId'
    ];

    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'userservicerequest', 'serviceId', 'userId');
    }

    public function organics(){
        return $this->belongsToMany(OrganicUnit::class, 'userserviceorganic', 'serviceId', 'organicUnitId')
            ->withPivot('userId');
    }


}