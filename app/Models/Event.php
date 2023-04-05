<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $primaryKey = 'eventid';

    public $timestamps = false;

    protected $fillable = [
        'requeststatus',
        'requesttype',
        'eventname',
        'address',
        'url',
        'email',
        'datecreated',
        'datereviewed',
        'contactperson',
        'description',
        'startdate',
        'enddate',
        'eventcanceled',
        'version',
    ];

    protected $casts = [
        'eventcanceled' => 'boolean',
    ];
    
    
    public function tags(){
        return $this->belongsToMany(Tag::class, 'eventtags', 'eventid', 'tagid');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'usereventrequest', 'eventid', 'userid');
    }

    public function organics(){
        return $this->belongsToMany(OrganicUnit::class, 'usereventorganic', 'eventid', 'organicunitid')
            ->withPivot('userid');
    }
}
