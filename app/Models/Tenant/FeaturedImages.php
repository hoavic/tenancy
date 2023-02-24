<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedImages extends Model
{
    use HasFactory;

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
