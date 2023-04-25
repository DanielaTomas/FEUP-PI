<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    protected $primaryKey = 'tagid';

    public $timestamps = false;

    protected $fillable = [
        'tagnameportuguese',
        'tagnameenglish',
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