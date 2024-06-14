@extends('layouts.main')
@section('content')
    @php xdebug_break() @endphp
    <x-tvShowIndex :title="$title" :tvShows="$tvShows" :itemsToShow="$itemsToShow ?? count($tvShows)"/>
@endsection
