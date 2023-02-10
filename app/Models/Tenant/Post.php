<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'content',
        'title',
        'excerpt',
        'status',
        'password',
        'name',
        'guid'
    ];

    public function users() {
        return $this->hasMany(User::class); 
    }

    public function categories() {
        return $this->belongsToMany(Category::class); 
    }

    public function comments() {
        return $this->hasMany(Comment::class); 
    }


}
