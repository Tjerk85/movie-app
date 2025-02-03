@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="md:max-w-[1000px] max-w-[350px]">
            <h1 class="mb-5 text-3xl">{{ $title }}</h1>
            <div class="grid md:grid-cols-4 mb-10 justify-center">
                @foreach($genres as $genre)
                    <a class="text-blue-700 text-2xl mt-5 mr-10" href="/genre/{{ $genre->name . "/" . $genre->id }}">{{ $genre->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
