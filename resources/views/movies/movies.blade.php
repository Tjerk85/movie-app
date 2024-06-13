@extends('layouts.main')
@section('content')
    <x-moviesIndex :title="$title" :movies="$movies" :itemsToShow="$itemsToShow ?? count($movies)"/>
@endsection
