@extends('layouts.main')
@section('content')
    <img
        class="opacity-60 absolute w-full"
        src="https://image.tmdb.org/t/p/w500{{ $movie->backdrop_path }}"
        alt=""
    >
    <div class="z-10 opacity-75 mr-20">
        <div class="flex ml-20 mt-20">
            <x-movie
                :movie="$movie->getMoviePoster()"
                :imageSize="500"
                :link="false"
            >
                <p><span class="font-bold">Year: </span>{{ $movie->release_date }}</p>
                @if(isset($servicesForMovies['NL']['flatrate']))
                    <p><span class="font-bold">Streaming Services NL (by JustWatch): </span>
                        @foreach($servicesForMovies['NL']['flatrate'] as $service)
                            {{ $service['provider_name'] }}@if(!$loop->last),@endif
                        @endforeach
                    </p>
                @endif

            </x-movie>
            <p class="content-center ml-10">{{ $movie->overview }}</p>
        </div>
    </div>

    <x-moviesIndex
        :movies="$similarMovies"
        :link="true"
        :title="'Similar Movies:'"
        :itemsToShow="$itemsToShow"
    />

@endsection
