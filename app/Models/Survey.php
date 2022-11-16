<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'rating', 'comment'];

    protected $casts = [
        'name' => CleanHtml::class,
        'email' => CleanHtml::class,
        'comment' => CleanHtml::class
    ];

    public function scopeTotalSurvey()
    {
        return $this->count();
    }

    public function scopeTotalRating($query, $value)
    {
        return $query->where('rating', $value)->count();
    }
}
