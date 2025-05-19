@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="md:max-w-[1000px] max-w-[350px]">
            <h1 class="md:ml-5 mb-5 text-2xl">Trending Movies:</h1>

            <div class="bg-gray-800 p-4 rounded">
                <span class="font-bold">Trending this: </span>
                <a href="{{ route('home') }}?trending=day">Day</a> |
                <a href="{{ route('home') }}/?trending=week">Week</a>
            </div>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @foreach($trendingMovies as $movie)
                    <x-movie
                        :movie="$movie"
                        :imageSize="400"
                        :link="true"
                    />
                @endforeach
            </div>
            <x-arrow :title="'More trending'" :route="route('trendingMovies').'/'. request()->input('trending')"/>

            <h1 class="ml-5 mb-5 text-2xl">Popular Movies:</h1>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @foreach($popularMovies as $movie)
                    <x-movie
                        :movie="$movie"
                        :imageSize="400"
                        :link="true"
                    />
                @endforeach
            </div>
            <x-arrow :title="'More popular'" :route="route('popularMovies')"/>

            <h1 class="ml-5 mb-5 text-2xl">Top-Rated Movies:</h1>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @foreach($topRatedMovies as $movie)
                    <x-movie
                        :movie="$movie"
                        :imageSize="400"
                        :link="true"
                    />
                @endforeach
            </div>
            <x-arrow :title="'More top-rated'" :route="route('topRatedMovies')"/>
        </div>
    </div>
@endsection

