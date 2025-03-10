@props(['movie' => null, 'link', 'imageSize', 'genres' => null, 'details' => false])

<div class="mb-10 mt-10 flex flex-col mr-2 space-y-8">
    @if($details)<p class="font-bold h-12 max-w-[200px]">{{ $movie->title }}</p>@endif
    @if($link)
        <a href="{{ route('showMovie', ['movieId' => $movie->id]) }}">
            <img
                src=@if($movie->poster_path) "https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $movie->poster_path }} @else {{ url($movie->poster_unknown) }} @endif"
                alt="{{ $movie->title }}"
            >
        </a>
    @else
        <img
            src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $movie->poster_path }}"
            alt="{{ $movie->title }}"
        >
    @endif

    <div class="max-w-[200px]">
        <p><span class="font-bold">Score: </span>{{ number_format($movie->vote_average, 1) }}</p>
        @if($details)
        <p>
            <span class="font-bold">Genre: </span>
            @foreach($movie->genre_ids as $genre)
                <a class="text-blue-700" href="{{ route('genre', ['typeOfMedia' => 'movie', 'genreName' => $genre->name, 'genreId' => $genre->id]) }}">
                    {{ $genre->name }}@if(!$loop->last),@endif
                </a>
            @endforeach
        </p>
        @endif
        {{ $slot }}
    </div>
</div>
