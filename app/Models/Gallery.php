<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlOutput;


class Gallery extends Model
{
    use HasFactory, Searchable;

    const SEARCHABLE_FIELDS = ['title'];

    protected $fillable = ['title', 'description', 'slug'];

    protected $casts = [
        'title' => CleanHtmlOutput::class,
        'description' => CleanHtml::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photos()
    {
        return $this->hasMany(\App\Models\Photo::class, 'gallery_id');
    }

    public function thumbnail()
    {
        return $this->photos()->first();
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
