@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="md:max-w-[1000px] max-w-[350px]">
            <x-actorsIndex
                :actors="$trendingActors"
                :title="'Trending Actors'"
                :itemsToShow="$itemsToShow"
                :maxContainerSize="'md:max-w-[1000px]'"
                :gridCols="'md:grid-cols-4'"
            >
                <div class="bg-gray-800 p-4 rounded mb-5">
                    <span class="font-bold">Trending this: </span>
                    <a href="{{ route('actors') }}?trending=day">Day</a> |
                    <a href="{{ route('actors') }}?trending=week">Week</a>
                </div>
            </x-actorsIndex>
            <x-arrow class="" :title="'More trending'" :route="route('trendingActors')"/>
        </div>
        <div class="md:max-w-[1000px] max-w-[350px]">
            <x-actorsIndex
                :actors="$popularActors"
                :title="'Popular Actors'"
                :itemsToShow="$itemsToShow"
                :maxContainerSize="'md:max-w-[1000px]'"
                :gridCols="'md:grid-cols-4'"
                />
            <x-arrow class="" :title="'More Popular'" :route="route('pupularActors')"/>
        </div>
    </div>   
@endsection
