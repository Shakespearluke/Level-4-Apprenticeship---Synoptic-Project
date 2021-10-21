<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    // Set fillable attributes.
    protected $fillable = [
        'quiz_id',
        'question_id',
        'answer',
        'correct',
    ];
}
