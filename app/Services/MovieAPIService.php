<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class MovieAPIService
{
    public function fetchTrendingMovies()
    {
        $response = Http::get('https://api.themoviedb.org/3/trending/all/day', [
            'api_key' => env('API_KEY')
        ]);

        return $response->json()['results'];
    }

    public function storeMoviesFromAPI()
    {
        $movies = $this->fetchTrendingMovies();

        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }

        return count($movies);
    }
}
