@props(['movies', 'title' => null, 'genres' => null, 'itemsToShow' => null])

<div class="flex z-10 flex-col items-center mt-5">
    <div class="md:max-w-[1000px] max-w-[350px]">
        <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
        <div class="grid md:grid-cols-4 grid-cols-2 justify-center">
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
