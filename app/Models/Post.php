<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'author',
        'content',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
    ];
}