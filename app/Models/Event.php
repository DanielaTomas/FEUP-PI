<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'eventId';

    public $timestamps = false;

    protected $fillable = [
        'RequestStatus',
        'RequestType',
        'eventName',
        'address',
        'url',
        'email',
        'dateCreated',
        'dateReviewed',
        'contactPerson',
        'description',
        'startDate',
        'endDate',
        'eventCanceled',
        'version',
        'tagId',
    ];

    protected $casts = [
        'eventCanceled' => 'boolean',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'tagId');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'usereventrequest', 'eventId', 'userId');
    }

    public function organics(){
        return $this->belongsToMany(OrganicUnit::class, 'usereventorganic', 'eventId', 'organicUnitId')
            ->withPivot('userId');
    }
}
