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
    ];

    public function answers(){
        return $this->hasMany(Answers::class,'question_id', 'id');
    }
}
