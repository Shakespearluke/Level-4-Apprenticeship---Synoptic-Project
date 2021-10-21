<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;

class Quizzes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'topic'
    ];

    public function questions(){
        return $this->hasMany(Questions::class,'quiz_id', 'id');
    }
}
