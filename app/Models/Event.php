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

    public function category()//TODO: is this correct, someone check
    {
        return $this->belongsTo(Category::class, 'tagId');
    }
}
