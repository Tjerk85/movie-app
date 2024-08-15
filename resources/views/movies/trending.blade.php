@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="md:max-w-[1000px] max-w-[350px]">
            <h1 class="ml-5 mb-5 text-2xl">Trending Movies:</h1>
            <div class="bg-gray-800 p-4 rounded">
                <span class="font-bold">Trending this: </span>
                <a href="{{ route('trendingMovies') }}/day">Day</a> |
                <a href="{{ route('trendingMovies') }}/week">Week</a>
            </div>
            <x-paginator :paginator="$paginator" :route="'trendingMovies'"/>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @foreach($movies as $movie)
                    <x-movie
                        :movie="$movie"
                        :imageSize="200"
                        :link="true"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection
