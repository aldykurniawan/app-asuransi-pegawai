<?php

namespace App\Models\DataMaster;

use App\Models\Model;

class File extends Model
{
    // appends file_path_url
    protected $appends = ['file_path_url'];

    // file_path_url
    public function getFilePathUrlAttribute()
    {
        return url($this->file_url);
    }

    // scope gallery
    public function scopeGallery($query)
    {
        return $query->where('fileable_type', 'App\Models\EPortal\Gallery');
    }
}
