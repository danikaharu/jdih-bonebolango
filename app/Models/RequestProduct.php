<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class RequestProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'job', 'request_title', 'request_purpose'];

    protected $casts = [
        'name' => CleanHtml::class,
        'email' => CleanHtml::class,
        'job' => CleanHtml::class,
        'request_title' => CleanHtml::class,
        'request_purpose' => CleanHtml::class,
    ];
}
