<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Services\MovieAPIService;

class MovieController extends Controller
{

    protected $movieService; // Declare the MovieAPIService property

    // Constructor to inject MovieAPIService instance
    public function __construct(MovieAPIService $movieService)
    {
        $this->movieService = $movieService; // Inject MovieAPIService instance
    }

    // Method to display the dashboard
    public function index()
    {
        // Call the storeMoviesFromAPI method from the MovieAPIService
        $movies = $this->movieService->storeMoviesFromAPI();

        // Return the view with the retrieved movies data
        return view('dashboard', compact('movies'));
    }
}