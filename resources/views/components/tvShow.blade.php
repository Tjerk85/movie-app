@props(['tvShow' => null, 'link', 'imageSize', 'genres' => null])

<div class="mb-10 justify-center items-center flex flex-col space-x-14 space-y-4 max-w-[400px]">
    @php xdebug_break() @endphp
    <p class="font-bold max-w-[180px]">{{ $tvShow->name }}</p>
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
