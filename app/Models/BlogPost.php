<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'image');
    }

}
