<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'users';

    ///
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
