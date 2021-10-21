<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    // Set fillable attributes.
    protected $fillable = [
        'quiz_id',
        'question',
    ];

    // Set has many relationship between questions and answers.
    public function answers(){
        return $this->hasMany(Answers::class,'question_id', 'id');
    }
}
