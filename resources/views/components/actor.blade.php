@props(['actor' => null, 'link', 'imageSize', 'textSize' => 'text-xs'])

<div class="mb-10 mt-10 flex flex-col mr-2 space-y-8">
    <p class="{{ $textSize }}">{{ $actor->name }}</p>
    @if($link)
        <a href="{{ route('showActor', ['id' => $actor->id]) }}">
            <img
                class="md:w-[200px] rounded"
                src=@if($actor->profile_path) "https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $actor->profile_path }} @else {{ url($actor->profile_path_unknown) }} @endif"
                alt="{{ $actor->name }}"
            >
        </a>
    @else
        <livewire:images
                :posterPath="$actor->profile_path"
                :imageSize="$imageSize"
                :mediaId="$actor->id"
                :title="$actor->name"
                :mediaType="'actor'"
        />
    @endif
    {{ $slot }}
</div>
