@props(['movie' => null, 'link', 'imageSize', 'genres' => null])

<div class="mb-10 justify-center items-center flex flex-col space-x-14 space-y-4 max-w-[400px]">

    <p class="font-bold max-w-[180px]">{{ $movie->title }}</p>
    @if($link)
        <a href="{{ route('showMovie', ['movieId' => $movie->id]) }}">
            <img
                src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $movie->poster_path }}"
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
        <p>
            <span class="font-bold">Genre: </span>
            @foreach($movie->genre_ids as $genre)
                <span>
                {{ $genre->name }}@if(!$loop->last),@endif
            </span>
            @endforeach
        </p>
        {{ $slot }}
    </div>
</div>
