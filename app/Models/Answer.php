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
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function question()
    {
        return $this->belongsTo(QuizeAnswer::class, 'question_id');
    }
}
