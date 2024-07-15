@props(['actors', 'title' => null, 'itemsToShow' => null])

<div class="flex z-10 flex-col items-center mt-5">
    <div class="max-w-[500px]">
        <h1 class="ml-5 mb-5 text-2xl">{{ $title }}</h1>
        <div class="grid grid-cols-5 gap-1 justify-center">
            @if(!empty($actors))
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
        </div>
    </div>
</div>
