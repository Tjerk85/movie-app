@extends('layouts.main')
@section('content')
    <div class="z-10 opacity-75 mr-20">
        <div class="flex ml-20 mt-20">
            <x-actor
                :actor="$actor"
                :imageSize="500"
                :link="false"
            >
                <p class="content-center"><span class="font-bold">Birthday: </span>
                    {{ $actor->birthday }}
                </p>
                @if($actor->deathday)
                    <p class="content-center"><span class="font-bold">Deathday: </span>
                        {{ $actor?->deathday }}
                    </p>
                @endif
                <p class="content-center"><span class="font-bold">Place of birth: </span>
                    {{ $actor?->place_of_birth }}
                </p>
                <p class="content-center"><span class="font-bold">Also known as: </span>
                    {{ implode(", ", $actor->also_known_as) }}
                </p>
                <p class="content-center"><span class="font-bold">imdb_id: </span>
                    {{ $actor->imdb_id  }}
                    {{-- todo make request to: https://api.themoviedb.org/3/find/nm5896355?external_source=imdb_id --}}
                </p>
            </x-actor>

            <p class="content-center ml-10 max-w-[800px]">{{ $actor->biography }}</p>
        </div>
    </div>

@endsection
