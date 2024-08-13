@extends('layouts.main')
@section('content')
    <div class="flex flex-col md:flex-row z-10 opacity-75 mr-20">
        <div class="ml-20 md:mt-20">
            <x-actor
                :actor="$actor"
                :imageSize="500"
                :link="false"
                :textSize="'text-4xl'"
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
        </div>
        <div class="content-center md:ml-10 ml-20 max-w-[800px] mb-10">
            <p class="mb-2"><span class="font-bold">Biography:</span></p>
            <p>{{ $actor->biography }}</p>
        </div>
    </div>

    <x-moviesIndex
        :movies="$moviesRelatedToActor"
        :link="true"
        :title="'Played in movies:'"
    />

    <x-tvShowIndex
        :tvShows="$tvShowRelatedToActor"
        :link="true"
        :title="'Played in tv shows:'"
    />

@endsection
