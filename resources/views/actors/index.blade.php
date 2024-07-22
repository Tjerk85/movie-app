@extends('layouts.main')
@section('content')
    <x-actorsIndex
        :actors="$trendingActors"
        :title="'Trending Actors'"
        :itemsToShow="$itemsToShow"
        :maxContainerSize="1000"
    >
        <div class="bg-gray-800 p-4 rounded mb-5">
            <span class="font-bold">Trending this: </span>
            <a href="{{ route('actors') }}?trending=day">Day</a> |
            <a href="{{ route('actors') }}/?trending=week">Week</a>
        </div>
    </x-actorsIndex>
    <x-actorsIndex
        :actors="$popularActors"
        :title="'Popular Actors'"
        :itemsToShow="$itemsToShow"
        :maxContainerSize="1000"
    />
@endsection
