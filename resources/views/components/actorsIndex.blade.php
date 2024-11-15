@props(['actors', 'title' => null, 'itemsToShow' => null, 'maxContainerSize' => 'max-w-[500px]', 'gridCols' => 'grid-cols-4'])

<div class="flex z-10 flex-col items-center mt-5">
    <div class="{{ $maxContainerSize }} max-w-[350px]">
        <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
        {{$slot}}
        <div class="grid {{ $gridCols }} grid-cols-2 gap-1 justify-center">

            @if(!empty($actors) && $actors instanceof \Illuminate\Support\Collection)
                @foreach($actors as $actor)
                    @if($itemsToShow ? $loop->index + 1 <= $itemsToShow : count($actors))
                        <x-actor
                            :actor="$actor"
                            :imageSize="400"
                            :link="true"
                            :textSize="'h-6'"
                        />
                    @endif
                @endforeach
            @endif

            @if(!empty($actors) && $actors instanceof \App\Models\ActorMovie)
                <x-actor
                    :actor="$actors"
                    :imageSize="400"
                    :link="true"
                />
            @endif

        </div>
    </div>
</div>
