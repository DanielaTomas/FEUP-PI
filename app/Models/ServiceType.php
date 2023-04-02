<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'servicetype';

    protected $primaryKey = 'serviceTypeId';

    public $timestamps = false;

    protected $fillable = [
        'serviceTypeName',
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
        'questionsId'
    ];

    public function question(){
        return $this->belongsTo(Question::class, 'questionsId');
    }

    public function service(){
        return $this->hasMany(Service::class);
    }
}