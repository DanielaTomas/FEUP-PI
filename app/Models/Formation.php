<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{   
    use HasFactory;
    
    protected $table = 'formation';
    protected $primaryKey = 'roleid';
    public $timestamps = false;

    protected $fillable = [
        'roletype',
        'userid',
        'organicunitid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    public function organicUnit()
    {
        return $this->belongsTo(OrganicUnit::class, 'organicunitid', 'organicunitid');
    }
}
