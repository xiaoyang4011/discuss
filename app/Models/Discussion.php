<?php

namespace App\Models;

use App\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'discussions';
    protected $fillable = ['title', 'body', 'user_id', 'last_user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
