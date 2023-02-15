<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'parent_id',
        'slug',
        'guid',
    ];

    public function posts() {
        return $this->belongsToMany(Post::class);
    }

    public function parent() {
        return $this->hasOne(Category::class, 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'id', 'parent_id');
    }
}
