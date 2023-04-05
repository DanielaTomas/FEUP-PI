<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    
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