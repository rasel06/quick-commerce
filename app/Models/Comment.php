<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    protected $fillable = ['post_id','comment','commented_by','is_approved','approved_by'];


    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        // Set created_by when creating a new post
        static::creating(function ($comment) {
            if (Auth::check()) {
                $comment->commented_by = Auth::id();
                $comment->approved_by = Auth::id(); // Also set updated_by on creation
            }
        });

        // Set updated_by when updating an existing post
        static::updating(function ($comment) {
            if (Auth::check()) {
                $comment->updated_by = Auth::id();
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
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }


    /**
     * Get the user who created this post
     */
    public function commenter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commented_by');
    }

    /**
     * Get the user who last updated this post
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }


}
