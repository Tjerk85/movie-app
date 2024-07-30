@extends('layouts.main')
@section('content')
    <div class="absolute bg-gray-600 bg-gradient-to-b from-transparent to-gray-950 w-full">
        <img src="https://image.tmdb.org/t/p/w500{{ $tvShow->backdrop_path }}" alt="Your Image"
             class="object-cover mix-blend-overlay opacity-70 w-full">
    </div>
    <div class="z-10 opacity-75 mr-20">
        <div class="flex sm:flex-row flex-col ml-20 mt-20">
        <x-tvShow
                :tvShow="$tvShow"
                :imageSize="500"
                :link="false"
            >
                <p><span class="font-bold">First air date: </span>{{ $tvShow->first_air_date }}</p>
                @if(isset($servicesForTvs['NL']['flatrate']))
                    <p><span class="font-bold">Streaming Services NL (by JustWatch): </span>
                        @foreach($servicesForTvs['NL']['flatrate'] as $service)
                            {{ $service['provider_name'] }}@if(!$loop->last),@endif
                        @endforeach
                    </p>
                @endif

            </x-tvShow>
            <p class="content-center m-auto ml-0 md:ml-10">{{ $tvShow->overview }}</p>
        </div>

        <x-actorsIndex
            :actors="$actors"
            :title="'Actors:'"
            :maxContainerSize="500"
            :gridCols="5"
        />
    </div>

    <x-tvShowIndex
        :tvShows="$similarTvShows"
        :link="true"
        :title="'Similar tv shows:'"
        :itemsToShow="$itemsToShow"
    />

@endsection
