<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    const SEARCHABLE_FIELDS = ['title'];

    protected $fillable = ['category_id', 'rule_number', 'year', 'determination_date', 'title', 'slug', 'file', 'status'];

    protected $cast = [
        'category_id', CleanHtml::class,
        'rule_number', CleanHtml::class,
        'year', CleanHtml::class,
        'title', CleanHtml::class,
        'status', CleanHtml::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
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

    public function status()
    {
        if ($this->status == 1) {
            return 'Mengubah';
        } elseif ($this->status == 2) {
            return 'Diubah';
        } elseif ($this->status == 3) {
            return 'Mencabut';
        } elseif ($this->status == 4) {
            return 'Dicabut';
        } else {
            return 'Berlaku';
        }
    }
}
