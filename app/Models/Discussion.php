<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Mews\Purifier\Casts\CleanHtml;

class Discussion extends Model
{
    use HasFactory, Searchable, Notifiable;

    const SEARCHABLE_FIELDS = ['subject'];

    protected $fillable = ['name', 'email', 'subject', 'slug', 'comment'];

    protected $casts = [
        'name' => CleanHtml::class,
        'email' => CleanHtml::class,
        'subject' => CleanHtml::class,
        'comment' => CleanHtml::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function reply()
    {
        return $this->hasOne(\App\Models\Reply::class);
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }
}
