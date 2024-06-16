@props(['tvShows', 'title' => null, 'genres' => null, 'itemsToShow' => null])

<div class="flex z-10 flex-col items-center mt-5">
    <div class="max-w-[1000px]">
        <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
        <div class="grid grid-cols-4 justify-center">
            @if(!empty($tvShows))
                @foreach($tvShows as $tvShow)
                    @if($itemsToShow ? $loop->index + 1 <= $itemsToShow : count($tvShows))
                        <x-tvShow
                            :tvShow="$tvShow"
                            :imageSize="200"
                            :link="true"
                        />
                    @endif
                @endforeach
            @else
                <p>{{ $tvShows }}</p>
            @endif
        </div>
    </div>
</div>
