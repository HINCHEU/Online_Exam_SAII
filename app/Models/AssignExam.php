<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignExam extends Model
{
    use HasFactory;
    protected $table = 'assignt_exam';

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    public function group()
    {
        return $this->belongsTo(group::class, 'group_id');
    }
    public function exam()
    {
        return $this->belongsTo(exam::class, 'exam_id');
    }
}
