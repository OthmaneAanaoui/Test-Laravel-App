<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class MovieAPIService
{
    public function fetchTrendingMovies()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('API_KEY'),
        ])->get('https://api.themoviedb.org/3/trending/all/day');

        return $response->json()['results'];
    }

    public function storeMoviesFromAPI()
    {
        $movies = $this->fetchTrendingMovies();

        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }

        return $movies;
    }
}
