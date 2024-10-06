<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = static::generateSlug($post->title);
        });
    }

    public static function generateSlug($title)
    {
        // Generate the initial slug
        $slug = Str::slug($title);

        // Check if any other slugs exist that are the same
        $original_slug = $slug;
        $count = 1;

        while (static::whereSlug($slug)->exists()) {
            $slug = $original_slug.'-'.$count++;
        }

        return $slug;
    }
}
