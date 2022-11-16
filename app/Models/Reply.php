<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['discussion_id', 'comment'];

    protected $casts = [
        'discussion_id' => CleanHtml::class,
        'comment' => CleanHtml::class,
    ];

    public function discussion()
    {
        return $this->belongsTo(\App\Models\Discussion::class);
    }
}
