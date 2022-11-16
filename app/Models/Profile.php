<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlOutput;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'body'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'title' => CleanHtmlOutput::class,
        'body' => CleanHtml::class,
    ];
}
