@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="md:max-w-[1000px] max-w-[350px]">
            <h1 class="ml-5 mb-5 text-2xl">Trending tv shows:</h1>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
            @foreach($onTheAirTvShows as $tvShow)
                    <x-tvShow
                        :tvShow="$tvShow"
                        :imageSize="400"
                        :link="true"
                    />
                @endforeach
            </div>
            <x-arrow :title="'More on the air'" :route="route('onTheAirTvShows')"/>

            <h1 class="ml-5 mb-5 text-2xl">Popular tv shows:</h1>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @foreach($popularTvShows as $tvShow)
                    <x-tvShow
                        :tvShow="$tvShow"
                        :imageSize="400"
                        :link="true"
                    />
                @endforeach
            </div>
            <x-arrow :title="'More popular'" :route="route('popularTvShows')"/>

            <h1 class="ml-5 mb-5 text-2xl">Top-Rated tv shows:</h1>
            <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
                @foreach($topRatedTvShows as $tvShow)
                    <x-tvShow
                        :tvShow="$tvShow"
                        :imageSize="400"
                        :link="true"
                    />
                @endforeach
            </div>
            <x-arrow :title="'More top-rated'" :route="route('topRatedTvShows')"/>
        </div>
    </div>
@endsection

