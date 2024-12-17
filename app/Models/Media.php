<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'path', 'uploaded_by'];

    // Get full URL for the media file
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
