<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'is_published', 'created_by', 'updated_by'];


    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        // Set created_by when creating a new post
        static::creating(function ($post) {
            if (Auth::check()) {
                $post->created_by = Auth::id();
                $post->updated_by = Auth::id(); // Also set updated_by on creation
            }
        });

        // Set updated_by when updating an existing post
        static::updating(function ($post) {
            if (Auth::check()) {
                $post->updated_by = Auth::id();
            }
        });

        // Optional: Set updated_by when saving (covers both create and update)
        // static::saving(function ($post) {
        //     if (Auth::check() && $post->exists) { // Only set updated_by for existing records
        //         $post->updated_by = Auth::id();
        //     }
        // });
    }


    /**
     * Get the user who created this post
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this post
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
