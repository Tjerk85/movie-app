@props(['paginator', 'route'])

<div class="flex justify-center m-5">
    <a
        class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
        href="{{ route('popularMovies') }}?page=1">
        <<<
    </a>

    @if(!is_null($paginator['previousPage']))
        <a
            class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
            href="{{ route($route) }}?page={{ $paginator['previousPage'] }}">
            < Previous
        </a>
    @endif

    @for ($i = 0; $i < 5; $i++)
        @if($i == 0 && !($paginator['previousPage'] < 101))
            <a
                class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
                href="{{ route($route) }}?page={{ $paginator['previousPage'] - $i - 100 }}">
                <<
            </a>
        @endif

        @if(!is_null($paginator['nextPage']) && !($paginator['nextPage'] + $i > 500))
            <a
                class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
                href="{{ route($route) }}?page={{ $paginator['nextPage'] + $i }}">
                {{ $paginator['nextPage'] + $i }}
            </a>
        @endif

        @if($i == 4 && !($paginator['nextPage'] + $i + 100 > 500))
            <a
                class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
                href="{{ route($route) }}?page={{ $paginator['nextPage'] + $i + 100 }}">
                >>
            </a>
        @endif
    @endfor

    @if(!is_null($paginator['nextPage']))
        <a
            class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
            href="{{ route($route) }}?page={{ $paginator['nextPage'] }}">
            Next >
        </a>
    @endif

    <a
        class="ml-5 bg-gray-400 p-1 pl-2 pr-2 rounded"
        href="{{ route($route) }}?page=500">
        >>>
    </a>
</div>
