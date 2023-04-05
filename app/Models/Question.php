<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $primaryKey = 'questionsid';

    public $timestamps = false;
    
    protected $fillable = [
        'question1',
        'question2',
        'question3',
        'question4',
        'question5',
        'question6',
        'question7',
        'question8',
        'question9',
        'question10'
    ];

    public function serviceType(){
        return $this->hasOne(ServiceType::class);
    }
}