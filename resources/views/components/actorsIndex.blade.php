@props(['actors', 'title' => null, 'itemsToShow' => null, 'maxContainerSize' => 200, 'gridCols' => 4])

<div class="flex z-10 flex-col items-center mt-5">
    <div class="max-w-[{{ $maxContainerSize }}px]">
        <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
        {{$slot}}
        <div class="grid grid-cols-{{$gridCols}} gap-1 justify-center">

            @if(!empty($actors) && $actors instanceof \Illuminate\Support\Collection)
                @foreach($actors as $actor)
                    @if($itemsToShow ? $loop->index + 1 <= $itemsToShow : count($actors))
                        <x-actor
                            :actor="$actor"
                            :imageSize="200"
                            :link="true"
                        />
                    @endif
                @endforeach
            @endif

            @if(!empty($actors) && $actors instanceof \App\Models\ActorMovie)
                <x-actor
                    :actor="$actors"
                    :imageSize="200"
                    :link="true"
                />
            @endif

        </div>
    </div>
</div>
