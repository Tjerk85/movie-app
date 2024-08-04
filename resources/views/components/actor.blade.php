@props(['actor' => null, 'link', 'imageSize', 'textSize' => 'text-xs'])

<div class="mb-10 mt-10 flex flex-col ml-5 space-y-8">
    <p class="font-bold h-6 max-w-[200px] {{ $textSize }}">{{ $actor->name }}</p>
    @if($link)
        <a href="{{ route('showActor', ['id' => $actor->id]) }}">
            <img
                class="w-[200px]"
                src=@if($actor->profile_path) "https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $actor->profile_path }} @else {{ url($actor->profile_path_unknown) }} @endif"
                alt="{{ $actor->name }}"
            >
        </a>
    @else
        <img
            class="w-[{{$imageSize}}px]"
            src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $actor->profile_path }}"
            alt="{{ $actor->name }}"
        >
    @endif
    {{ $slot }}
</div>
