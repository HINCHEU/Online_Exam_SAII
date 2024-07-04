<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers1';

    protected $fillable = [
        'exam_id',
        'question_id',
        'user_id',
        'answer',
    ];
}
