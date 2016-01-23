<?php

namespace App\Models;

use App\Models\Discussion;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function discussions(){
        return $this->belongsToMany(Discussion::class);
    }
}
