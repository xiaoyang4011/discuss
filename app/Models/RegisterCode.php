<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterCode extends Model
{
    protected $table = 'register_code';
    protected $fillable = ['status', 'register_code', 'use_user_id'];
}
