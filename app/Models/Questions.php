<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'answer_5',
        'correct_answers'
    ];
}
