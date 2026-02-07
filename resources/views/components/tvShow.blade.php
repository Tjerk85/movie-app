@props(['tvShow' => null, 'link', 'imageSize', 'genres' => null,  'details' => false])

<div class="mb-10 mt-10 flex flex-col mr-2 space-y-8">
    @if($details)<p class="font-bold h-12 max-w-[200px]">{{ $tvShow->name }}</p>@endif
    @if($link)
        <a href="{{ route('showTvShow', ['tvShowId' => $tvShow->id]) }}">
            <img
                src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $tvShow->poster_path }}"
                alt="{{ $tvShow->name }}"
                class="cursor-pointer hover:scale-105 duration-300 rounded-xl hover:opacity-75 bg-black"
            >
        </a>
    @else
        <img
            src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $tvShow->poster_path }}"
            alt="{{ $tvShow->name }}"
            class="cursor-pointer hover:scale-105 duration-300 rounded-xl hover:opacity-75 bg-black"
        >
    @endif

    <div class="max-w-[200px]">
        <p><span class="font-bold">Score: </span>{{ number_format($tvShow->vote_average, 1) }}</p>
        @if($details)
        <p>
            <span class="font-bold">Genre: </span>
            @foreach($tvShow->genre_ids as $genre)
                <a class="text-blue-700" href="{{ route('genre', ['typeOfMedia' => 'tv', 'genreName' => $genre->name, 'genreId' => $genre->id]) }}">
                    {{ $genre->name }}@if(!$loop->last),@endif
                </a>
            @endforeach
        </p>
        @endif
        {{ $slot }}
    </div>
</div>
