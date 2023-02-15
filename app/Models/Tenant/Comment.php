<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function parent() {
        return $this->hasOne(Comment::class, 'id', 'parent_id');
    }

    public function children() {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

}
