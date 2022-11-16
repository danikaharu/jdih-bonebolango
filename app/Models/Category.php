<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'short_title', 'slug', 'icon', 'description'];

    protected $casts = [
        'title' => CleanHtml::class,
        'short_title' => CleanHtml::class,
        'icon' => CleanHTML::class,
        'description' => CleanHtml::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
