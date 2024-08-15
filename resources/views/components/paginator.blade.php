@props(['paginator', 'route'])

<div class="flex justify-center mt-10 space-x-2">
    <a
        class="px-2 py-1 sm:px-4 sm:py-2 mt-2 text-gray-600 border rounded-lg hover:bg-gray-100 focus:outline-none"
        href="{{ route('popularMovies') }}?page=1">
        <<<
    </a>

    @if(!is_null($paginator['previousPage']))
        <a
            class="px-2 py-1 sm:px-4 sm:py-2 mt-2 text-gray-600 border rounded-lg hover:bg-gray-100 focus:outline-none"
            href="{{ route($route) }}?page={{ $paginator['previousPage'] }}">
            <
        </a>
    @endif

    @for ($i = 0; $i < 2; $i++)
        @if($i == 0 && !($paginator['previousPage'] < 101))
            <a
                class="hover:bg-gray-100 px-2 py-1 sm:px-4 sm:py-2 ml-1 mt-2 text-gray-600 border rounded-lg focus:outline-none"
                href="{{ route($route) }}?page={{ $paginator['previousPage'] - $i - 100 }}">
                <<
            </a>
        @endif

        @if($i == 0)
            <a
                class="ring ring-primary bg-primary/20 px-2 py-1 sm:px-4 sm:py-2 ml-1 mt-2 text-gray-600 border rounded-lg focus:outline-none"
                href="{{ route($route) }}?page={{ $paginator['currentPage'] }}">
                {{ $paginator['currentPage'] }}
            </a>
        @endif

        @if(!is_null($paginator['nextPage']) && !($paginator['nextPage'] + $i > 500))
            <a
                class="hover:bg-gray-100 px-2 py-1 sm:px-4 sm:py-2 ml-1 mt-2 text-gray-600 border rounded-lg focus:outline-none"
                href="{{ route($route) }}?page={{ $paginator['nextPage'] + $i }}">
                {{ $paginator['nextPage'] + $i }}
            </a>
        @endif

        @if($i == 1 && !($paginator['nextPage'] + $i + 100 > 500))
            <a
                class="px-2 py-1 sm:px-4 sm:py-2 mt-2 text-gray-600 border rounded-lg hover:bg-gray-100 focus:outline-none"
                href="{{ route($route) }}?page={{ $paginator['nextPage'] + $i + 100 }}">
                >>
            </a>
        @endif
    @endfor

    @if(!is_null($paginator['nextPage']))
        <a
            class="px-2 py-1 sm:px-4 sm:py-2 mt-2 text-gray-600 border rounded-lg hover:bg-gray-100 focus:outline-none"
            href="{{ route($route) }}?page={{ $paginator['nextPage'] }}">
            >
        </a>
    @endif

    <a
        class="px-2 py-1 sm:px-4 sm:py-2 mt-2 text-gray-600 border rounded-lg hover:bg-gray-100 focus:outline-none"
        href="{{ route($route) }}?page=500">
        >>>
    </a>
</div>
