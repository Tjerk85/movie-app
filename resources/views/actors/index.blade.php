@extends('layouts.main')
@section('content')
    <x-actorsIndex
        :actors="$popularActors"
        :title="'Popular Actors'"
        :itemsToShow="$itemsToShow"
        :maxContainerSize="1000"
    />

    <x-actorsIndex
        :actors="$trendingActors"
        :title="'Trending Actors'"
        :itemsToShow="$itemsToShow"
        :maxContainerSize="1000"
    />
@endsection
