@extends('layouts.main')
@section('content')
    <x-tvShowIndex :title="$title" :tvShows="$tvShows" :itemsToShow="$itemsToShow ?? count($tvShows)"/>
@endsection
