<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Overtrue\LaravelVersionable\Versionable;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;
use Carbon\CarbonInterface;


class Event extends Model implements Feedable 
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


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'eventtags', 'eventid', 'tagid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function organicUnit()
    {
        return $this->belongsTo(OrganicUnit::class, 'organicunitid');
    }


    public function toFeedItem(): FeedItem
    {      
        $this->load('user');
        $user = $this->user;
        return FeedItem::create()
            ->id($this->eventid)
            ->title($this->eventnameenglish)
            ->summary($this->description)
            ->updated(Carbon::parse($this->datecreated))
            ->link('/events/' . $this->eventid)
            ->authorName($user->name)
            ->authorEmail($this->emailtechnical);
    }
}
