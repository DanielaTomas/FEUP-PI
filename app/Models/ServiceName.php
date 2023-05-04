<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceName extends Model
{   
    use HasFactory;
    
    protected $table = 'servicename';

    protected $primaryKey = 'servicenameid';

    public $timestamps = false;

    protected $fillable = [
        'servicenameportuguese','servicenameenglish',
    ];

    public function organicunits()
    {
        return $this->belongsToMany(OrganicUnit::class, 'organicservice', 'servicenameid', 'organicunitid');
    }

    public function question()
    {
        return $this->hasOne(Question::class, 'servicenameid');
    }

}