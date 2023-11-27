@extends('layouts.app')

@section('content')
    {{-- Movie Info --}}
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}" alt="poster" class="w-64 lg:w-96">
            </div>
            <div class="mt-8 md:mt-0 md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-2">
                    <svg class="fill-current text-orange-500 w-5" viewBox="0 0 24 24">
                        <path d="M22,9.81a1,1,0,0,0-.83-.69l-5.7-.78L12.88,3.53a1,1,0,0,0-1.76,0L8.57,8.34l-5.7.78a1,1,0,0,0-.82.69,1,1,0,0,0,.28,1l4.09,3.73-1,5.24A1,1,0,0,0,6.88,20.9L12,18.38l5.12,2.52a1,1,0,0,0,.44.1,1,1,0,0,0,1-1.18l-1-5.24,4.09-3.73A1,1,0,0,0,22,9.81Z"/>
                    </svg>
                    <span class="ml-1">{{ $movie['vote_average'] * 10 . '%'}}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                    <span class="mx-2">|</span>
                    <span>{{--film türü;--}}
                        @foreach ($movie['genres'] as $genre)
                        {{ $genre['name'] }}@if (!$loop->last), @endif
                        @endforeach
                    </span>
                </div>
                <p class="text-gray-300 mt-8">{{ $movie['overview'] }}</p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">

                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 2)
                                <div class="mr-8">
                                    <span>{{ $crew['name'] }}</span>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>
                            @endif
                        @endforeach
                        
                    </div>
                </div>

                @if (count($movie['videos']['results']) > 0)
                    <div class="mt-12">
                        <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][1]['key'] }}" target="_blank" 
                        class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                        >
                            <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                            <span class="ml-2">Play Trailer</span>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- /Movie Info --}}

    {{-- Movie Cast --}}
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                
                @foreach ($movie['credits']['cast'] as $cast)
                    @if ($loop->index < 5)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{'https://image.tmdb.org/t/p/w300' . $cast['profile_path'] }}" alt="Movie Casts" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="text-lg mt-2 hover:text-gray-300 font-semibold">{{ $cast['name'] }}</a>
                                <div class="text-gray-400 text-sm">{{ $cast['character'] }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
    {{-- /Movie Cast --}}

    {{-- Movie Images --}}
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                
                @foreach ($movie['images']['backdrops'] as $image)
                    @if ($loop->index < 6)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{'https://image.tmdb.org/t/p/w500' . $image['file_path'] }}" alt="Movie Images" 
                                     class="hover:opacity-75 transition ease-in-out duration-150"
                                >
                            </a>
                        </div>
                    @endif
                @endforeach
                
            </div>
        </div>
    </div>
    {{-- /Movie Images --}}

@endsection