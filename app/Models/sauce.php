<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sauce extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'name',
        'manufacturer',
        'description',
        'mainPepper',
        'imageUrl',
        'heat',
        'likes',
        'dislikes',
        'usersLiked',
        'usersDisliked',
    ];

    protected $casts = [
        'usersLiked' => 'array',
        'usersDisliked' => 'array',
    ];
}
