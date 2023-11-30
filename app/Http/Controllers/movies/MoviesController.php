<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;

class MoviesController extends Controller
{
    public function index()
    {
        $apiKey = '68fec7b5ce41029ca9f94239ce5bab09'; // TMDB API anahtarınız

        $popularUrl = 'https://api.themoviedb.org/3/movie/popular?api_key=' . $apiKey;
        $popularMovies = Http::get($popularUrl)->json()['results'];

        $playingUrl = 'https://api.themoviedb.org/3/movie/now_playing?api_key=' . $apiKey;
        $nowPlayingMovies = Http::get($playingUrl)->json()['results'];

        $genreUrl = 'https://api.themoviedb.org/3/genre/movie/list?api_key=' . $apiKey;
        $genres = Http::get($genreUrl)->json()['genres'];

        //normalde karışık bir array döndürüyor. bunu key value şeklinde döndürmek için mapWithKeys kullanıyoruz.
        
        /* 
        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
        */

        // dump($nowPlayingMovies);

        /*
        return view('index', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres,
        ]);
        */
        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('index', $viewModel);
    }

    public function show($id)
    {
        //*append_to_response=credits ekleyerek filmin oyuncularını da çekebiliriz 
        //*credits,videos,images şeklinde birden fazla parametre de gönderebiliriz.
        $url = 'https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images&api_key='.config('services.tmdb.token');
        $movie = Http::get($url)->json();

        // dump($movie);

        return view('movies', [
            'movie' => $movie,
        ]);

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
