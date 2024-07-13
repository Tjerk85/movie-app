@props(['movies', 'title' => null, 'genres' => null, 'itemsToShow' => null])

<div class="flex z-10 flex-col items-center mt-5">
    <div class="max-w-[1000px]">
        <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
        <div class="grid grid-cols-4 justify-center">
            @if(!empty($movies))
                @foreach($movies as $movie)
                    @if($itemsToShow ? $loop->index + 1 <= $itemsToShow : count($movies))
                        <x-movie
                            :movie="$movie"
                            :imageSize="200"
                            :link="true"
                        />
                    @endif
                @endforeach
            @else
                <p>{{ $movies }}</p>
            @endif
        </div>
    </div>
</div>
