<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Overtrue\LaravelVersionable\Versionable;

class Service extends Model
{   
    use HasFactory;
    //use Versionable; 
    protected $table = 'service';

    protected $primaryKey = 'serviceid';

    public $timestamps = false;

    protected $fillable = [
        'servicename',
        'requeststatus',
        'requesttype',
        'purpose',
        'email',
        'contactperson',
        'url',
        'version',
        'startdate',
        'enddate',
        'servicetypeid'
    ];

    protected $versionable = [
        'servicename',
        'purpose',
        'email',
        'contactperson',
        'url',
        'version',
        'startdate',
        'enddate',
    ];

    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'userservicerequest', 'serviceid', 'userid');
    }

    public function organics(){
        return $this->belongsToMany(OrganicUnit::class, 'userserviceorganic', 'serviceid', 'organicunitid')
            ->withPivot('userid');
    }


}