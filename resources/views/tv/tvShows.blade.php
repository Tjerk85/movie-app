@extends('layouts.main')
@section('content')
    <x-paginator :paginator="$paginator" :route="'onTheAirTvShows'"/>
    <x-tvShowIndex :title="$title" :tvShows="$tvShows" :itemsToShow="$itemsToShow ?? count($tvShows)"/>
@endsection
