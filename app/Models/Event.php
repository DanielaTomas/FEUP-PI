<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Overtrue\LaravelVersionable\Versionable;


class Event extends Model
{
    use HasFactory;
    //use Versionable;

    protected $table = 'event';

    protected $primaryKey = 'eventid';

    public $timestamps = false;

    protected $fillable = [
        'requeststatus',
        'requesttype',
        'eventnameportuguese',
        'eventnameenglish',
        'address',
        'urlportuguese',
        'urlenglish',
        'emailtechnical',
        'emailcontact',
        'datecreated',
        'datereviewed',
        'contactperson',
        'description',
        'startdate',
        'enddate',
        'eventcanceled',
        'userid',
        'organicunitid'

    ];

    protected $versionable = [
        'eventnameportuguese',
        'eventnameenglish',
        'address',
        'urlportuguese',
        'urlenglish',
        'emailtechnical',
        'emailcontact',
        'contactperson',
        'description',
        'startdate',
        'enddate',
        'eventcanceled',
        'organicunitid'
    ];

    protected $casts = [
        'eventcanceled' => 'boolean',
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->where('eventnameportuguese', 'like', '%' . $searchTerm . '%')
                  ->orWhere('eventnameenglish', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
        });
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'eventtags', 'eventid', 'tagid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function organicUnit()
    {
        return $this->belongsTo(OrganicUnit::class, 'organicunitid');
    }
}
