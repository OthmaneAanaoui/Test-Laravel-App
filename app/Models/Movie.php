<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'adult',
        'backdrop_path',
        'name',
        'title',
        'original_language',
        'original_name',
        'overview',
        'poster_path',
        'media_type',
        'genre_ids',
        'popularity',
        'first_air_date',
        'vote_average',
        'vote_count',
        'origin_country'
    ];

    protected $casts = [
        'genre_ids' => 'json',
        'origin_country' => 'json',
        'first_air_date' => 'date'
    ];
}
