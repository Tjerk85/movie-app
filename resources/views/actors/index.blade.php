@extends('layouts.main')
@section('content')
    <div class="flex flex-col items-center mt-5">
        <div class="max-w-[1000px]">
            <h1 class="ml-5 mb-5 text-2xl">Trending tv shows:</h1>
            <div class="grid grid-cols-4 justify-center">
                @foreach($actors as $actor)
                    <x-actor
                        :actor="$actor"
                        :imageSize="200"
                        :link="true"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection

