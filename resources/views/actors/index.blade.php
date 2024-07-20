@extends('layouts.main')
@section('content')
    <x-actorsIndex
        :actors="$popularActors"
        :title="'Popular Actors'"
        :itemsToShow="8"
        :maxContainerSize="1000"
    />
@endsection
