<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exams';

    public function questions()
    {
        return $this->hasMany(QuizeAnswer::class, 'quize_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
