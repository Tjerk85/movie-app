@props(['tvShow' => null, 'link', 'imageSize', 'genres' => null])

<div class="mb-10 mt-10 flex flex-col mr-2 space-y-8">
    <p class="font-bold h-12 max-w-[200px]">{{ $tvShow->name }}</p>
    @if($link)
        <a href="{{ route('showTvShow', ['tvShowId' => $tvShow->id]) }}">
            <img
                src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $tvShow->poster_path }}"
                alt="{{ $tvShow->name }}"
            >
        </a>
    @else
        <img
            src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $tvShow->poster_path }}"
            alt="{{ $tvShow->name }}"
        >
    @endif

    <div class="max-w-[200px]">
        <p><span class="font-bold">Score: </span>{{ number_format($tvShow->vote_average, 1) }}</p>
        <p>
            <span class="font-bold">Genre: </span>
            @foreach($tvShow->genre_ids as $genre)
                <span>
                {{ $genre->name }}@if(!$loop->last),@endif
            </span>
            @endforeach
        </p>
        {{ $slot }}
    </div>
</div>
