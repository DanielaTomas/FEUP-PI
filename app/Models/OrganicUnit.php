<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganicUnit extends Model
{
    protected $table = 'organicunit';

    protected $primaryKey = 'organicUnitId';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

}