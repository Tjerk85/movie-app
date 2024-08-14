@extends('layouts.main')
@section('content')
    <div class="absolute bg-gray-600 bg-gradient-to-b from-transparent to-gray-950 w-full">
        <img src="https://image.tmdb.org/t/p/w500{{ $movie->backdrop_path }}" alt="Your Image"
             class="object-cover mix-blend-overlay opacity-70 w-full">
    </div>
    <div class="z-10 opacity-75 mr-20">
        <div class="flex sm:flex-row flex-col ml-20 md:mt-20">
            <x-movie
                :movie="$movie"
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
            <p class="content-center m-auto md:ml-10">{{ $movie->overview }}</p>
        </div>
    </div>

    <x-actorsIndex
        :actors="$actors"
        :title="'Actors:'"
        :maxContainerSize="500"
        :gridCols="'grid-cols-5'"
    />

    <x-moviesIndex
        :movies="$similarMovies"
        :link="true"
        :title="'Similar Movies:'"
        :itemsToShow="$itemsToShow"
    />

@endsection
