<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property string url_key
 * @property string title
 */
class Post extends Model
{
    use HasFactory;

    const STATE_DRAFT = 'draft';

    protected $fillable = [
        'title',
        'author_id',
        'state',
        'short_content',
        'content',
        'image',
        'url_key',
        'meta_description',
        'meta_keywords',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->author_id = \Auth::user()->id;
        });
    }

    protected function urlKey(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ?? Str::slug($this->title)
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }


}
