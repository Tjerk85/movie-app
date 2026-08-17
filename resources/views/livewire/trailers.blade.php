<div x-data="{ expandedTrailer: false }"">
    <a class="text-blue-700 cursor-pointer" 
       x-on:click="expandedTrailer = !expandedTrailer; expanded = false"
       wire:click="openVideos({{ $mediaId }})"
    >
    Trailers
    </a>

    @teleport('body')
        <div  x-show="expandedTrailer" x-on:click.outside="expandedTrailer = false">
            <span x-on:click="expandedTrailer = false"
                class="fixed z-[99] top-14 xl:top-36 right-14 text-2xl text-gray-400 cursor-pointer"
            >&#x2715;
            </span>
        
            <div class="md:p-10 p-4 top-10 xl:top-32 left-10 right-10 bg-black rounded-lg fixed overflow-y-auto max-h-[75vh] z-[10] grid md:grid-cols-3 grid-cols-1 gap-4">
                @foreach ($videos as $video)
                <iframe src="https://www.youtube-nocookie.com/embed/{{ $video['key'] }}?si=FaqHkborR8nm4oGF" \
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen
                        class="w-64 md:w-none"
                    >
                </iframe>
                @endforeach    
            </div>
        </div>
    @endteleport
</div>
