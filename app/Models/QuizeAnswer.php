<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizeAnswer extends Model
{
    use HasFactory;
    protected $table = 'quize_answers';
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
