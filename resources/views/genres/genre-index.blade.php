@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="md:max-w-[1000px] max-w-[350px]">
            <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
            <x-paginator :paginator="$paginator" :route="'trendingMovies'"/>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @if(isset($movies))
                    @foreach($movies as $movie)
                        <x-movie
                            :movie="$movie"
                            :imageSize="200"
                            :link="true"
                        />
                    @endforeach
                @elseif(isset($tvShows))
                    @foreach($tvShows as $tvShow)
                        <x-tvShow
                                :tvShow="$tvShow"
                                :imageSize="200"
                                :link="true"
                        />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
