<div x-data="{ showImage: false }">
    <img x-on:click="showImage = !showImage"
         src="https://image.tmdb.org/t/p/w300{{ $imageUrl }}"
         alt="{{ $movieTitle }}"
         class="ml-auto mr-auto mt-2 hover:scale-105 duration-300 rounded-xl cursor-pointer"
    >

    <div x-on:click.outside="showImage = false" x-show="showImage">
            <div class="p-2 md:p-10 top-4 md:top-10 xl:top-32 left-2 md:left-10 right-2 md:right-10 bg-black rounded-lg fixed overflow-y-auto max-h-[80vh] z-[99] group">
            <img x-show="showImage"
                 x-on:click="showImage = false"
                 x-on:click.outside="showImage = false"
                 src="https://image.tmdb.org/t/p/original{{ $imageUrl }}"
                 alt="{{ $movieTitle }}"
                 class="ml-auto mr-auto mt-2 rounded-lg cursor-pointer"
            >

            <div class="absolute inset-0 flex p-4 opacity-0 translate-y-4  group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 cursor-pointer">
                <p class="text-white text-sm">
                    Click to close
                </p>
            </div>
        </div>
    </div>
</div>
