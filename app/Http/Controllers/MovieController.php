<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Services\MovieAPIService;

class MovieController extends Controller
{

    protected $movieService;

    public function __construct(MovieAPIService $movieService)
    {
        $this->movieService = $movieService;
    }


    public function index()
    {
        $trendingMovies = $this->movieService->storeMoviesFromAPI();

        return response()->json($trendingMovies);
    }
}