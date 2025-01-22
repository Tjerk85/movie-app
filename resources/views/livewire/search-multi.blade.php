<div x-data="{ expanded: false }">
    <input wire:model.live="search"
           x-on:click.outside="expanded = true"
           x-on:click="expanded = false"
           type="text"
           id="search"
           name="search"
           class="bg-gray-950
           border-gray-400
           focus:bg-gray-600
           border
           text-gray-400
           text-sm rounded-lg
           focus:ring-red-500
           focus:border-red-500
           block
           sm:w-[445px]
           w-[350px]
           p-2.5
           dark:bg-gray-700
           dark:border-gray-600
           dark:placeholder-gray-400
           dark:text-white
           dark:focus:ring-blue-500
           dark:focus:border-blue-500"
           placeholder="E.g: Matrix reloaded"/>

    @if(strlen($search) >= 2 && !is_null($results))
        <div x-show="! expanded" class="absolute bg-gray-900 pl-4 pr-5 pb-2 rounded border-2 border-gray-500 mr-10 w-[450px] h-[600px] overflow-auto">
            <ul>
                @foreach ($results as $result)
                    <li wire:key="{{ $result->id }}" class="p-2 border-gray-500 border-b-2">
                        <a href="{{ $result->medium }}" class="flex flex-row items-center">
                            <img
                                    class="w-12 mr-2"
                                    src="https://image.tmdb.org/t/p/w200{{ $result->poster_path }}"
                                    alt="{{ $result->name }}"
                            >
                            <p>{{ $result->name }}<p/>
                        </a>
                    </li>
                @endforeach
            </ul>
            @elseif(strlen($search) > 0)
                <ul class="absolute bg-gray-900 pl-4 pr-5 pb-2 pt-3 rounded mr-10 overflow-auto">
                    <li>No results for:</li>
                    <li>{{ $search }}</li>
                </ul>
        </div>
    @endif
</div>
