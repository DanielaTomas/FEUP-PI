<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $primaryKey = 'tagid';

    public $timestamps = false;

    protected $fillable = [
        'tagname',
    ];

    /*
    public function events(){
        return $this->hasMany(Event::class);
    }
    */

    public function events()
    {
        return $this->belongsToMany(Event::class, 'eventtags', 'tagid', 'eventid');
    }

}