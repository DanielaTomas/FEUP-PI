<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'servicetype';

    protected $primaryKey = 'servicetypeid';

    public $timestamps = false;

    protected $fillable = [
        'servicetypename',
        'atribute1',
        'atribute2',
        'atribute3',
        'atribute4',
        'atribute5',
        'atribute6',
        'atribute7',
        'atribute8',
        'atribute9',
        'atribute10',
        'questionsid'
    ];

    public function question(){
        return $this->belongsTo(Question::class, 'questionsid');
    }

    public function service(){
        return $this->hasMany(Service::class);
    }
}