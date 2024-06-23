<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $table = 'students';

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    public function group()
    {
        return $this->belongsTo(group::class, 'group_id');
    }
}
