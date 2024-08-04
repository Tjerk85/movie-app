@extends('layouts.main')
@section('content')
    <x-paginator :paginator="$paginator" :route="'popularMovies'"/>
    <x-moviesIndex :title="$title" :movies="$movies" :itemsToShow="$itemsToShow ?? count($movies)"/>
@endsection
