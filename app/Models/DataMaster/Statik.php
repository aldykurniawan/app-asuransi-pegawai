<?php

namespace App\Models\DataMaster;

use App\Models\Model;

class Statik extends Model
{
    // casts content to json
    protected $casts = [
        'content' => 'json',
    ];

    // scopeSlug
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
