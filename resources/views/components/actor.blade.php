@props(['actor' => null, 'link', 'imageSize'])

<div class="mb-10 mt-10 flex flex-col max-w-[400px]">

    <p class="font-bold text-xs h-12">{{ $actor->name }}</p>
    @if($link)
        <a href="{{ route('showMovie', ['movieId' => $actor->id]) }}">
            <img
                class="w-[200px]"
                src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $actor->profile_path }}"
                alt="{{ $actor->name }}"
            >
        </a>
    @else
        <img
            class="w-[200px]"
            src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $actor->profile_path }}"
            alt="{{ $actor->name }}"
        >
    @endif

</div>
