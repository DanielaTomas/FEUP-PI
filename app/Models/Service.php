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

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}