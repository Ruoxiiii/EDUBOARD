<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $fillable = ['title', 'content', 'category', 'posted_by', 'likes', 'comments', 'media_paths', 'is_pinned', 'pinned_at'];

    protected $casts = [
        'media_paths' => 'array',
        'pinned_at' => 'datetime',
    ];

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
