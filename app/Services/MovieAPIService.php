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
        ])->get('https://developers.themoviedb.org/3/trending/get-trending');

        return $response->json()['results'];
    }

    public function storeMoviesFromAPI()
    {
        $movies = $this->fetchTrendingMovies();

        foreach ($movies as $movieData) {
            // Extract the movie ID from the data
            $movieId = $movieData['id'];

            // Update or create the movie using the movie ID as the key
            Movie::updateOrCreate(['id' => $movieId], $movieData);
        }

        return $movies;
    }
}
