@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="max-w-[1000px]">
            <h1 class="ml-5 mb-5 text-2xl">Trending Movies:</h1>
            <div class="bg-gray-800 p-4 rounded">
                <span class="font-bold">Trending this: </span>
                <a href="{{ route('trendingMovies') }}/day">Day</a> |
                <a href="{{ route('trendingMovies') }}/week">Week</a>
            </div>
            <div class="grid grid-cols-4 justify-center">
                @foreach($movies as $movie)
                    <x-movie
                        :movie="$movie->getMoviePoster()"
                        :imageSize="200"
                        :link="true"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection
