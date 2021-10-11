<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'post_text', 'is_published'];

    protected $casts = [
        'is_published' => 'boolean'
    ];
}
