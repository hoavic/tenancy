<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use \Illuminate\Database\Eloquent\SoftDeletes;

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

/*     public static function resetActionsPerformed()
    {
        static::$actionsPerformed = 0;
    } */

    public function posts() {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }

    public function parent() {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
