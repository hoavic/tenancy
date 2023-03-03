<?php

namespace App\Models\Tenant;

use App\Models\Tenant\PostMetaValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostMeta extends Model
{
    use HasFactory;

    protected $table='postmetas';

    protected $fillable = [
        'key',
        'value',
        'visual',
        'label',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
