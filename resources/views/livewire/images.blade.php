<div x-data="{ expanded: false }">
        <img x-on:click="expanded = !expanded"
             src="https://image.tmdb.org/t/p/w{{ $imageSize }}/{{ $posterPath }}"
             alt="{{ $movieTitle }}"
             wire:click="openImages({{ $movieId }})"
             class="cursor-pointer hover:scale-105 duration-300 rounded-xl"
        >

    <div wire:loading>
        <span class="fixed top-0 left-0 w-full h-screen bg-black bg-opacity-50 flex items-center justify-center">
            Images are loading...
        </span>
    </div>

    @if ($activeMovieId === $movieId)
        @teleport('body')
            <div x-on:click.outside="expanded = false"
                 x-show="expanded"
                 wire:loading.remove
            >
                <span x-on:click="expanded = false"
                      class="fixed z-[99] top-14 xl:top-36 right-14 text-2xl text-gray-400 cursor-pointer"
                >&#x2715;
                </span>

                <div class="p-10 top-10 xl:top-32 left-10 right-10 bg-black rounded-lg fixed overflow-y-auto max-h-[75vh] z-[10]">
                    <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                        @foreach($images['backdrops'] as $backdrops)
                            <livewire:image x-show="!showImage" :imageUrl="$backdrops['file_path']" :movieTitle="$movieTitle" />
                            @if ($loop->iteration === 9)
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endteleport
    @endif
</div>
