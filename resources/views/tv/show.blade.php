@extends('layouts.main')
@section('content')
    <img
        class="opacity-60 absolute w-full"
        src="https://image.tmdb.org/t/p/w500{{ $tvShow->backdrop_path }}"
        alt=""
    >
    <div class="z-10 opacity-75 mr-20">
        <div class="flex ml-20 mt-20">
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
            <p class="content-center ml-10">{{ $tvShow->overview }}</p>
        </div>
    </div>

    <x-tvShowIndex
        :tvShows="$similarTvShows"
        :link="true"
        :title="'Similar tv shows:'"
        :itemsToShow="$itemsToShow"
    />

@endsection
