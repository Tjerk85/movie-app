<div class="group-hover:block dropdown-menu absolute hidden h-auto">
    <ul class="top-0 w-48 border-gray-500 bg-gray-900 shadow px-6 py-8 rounded">
        <li>
            <a href="{{ route('index', ['typeOfMedia' => $typeOfMedia]) }}"
               class="block px-4 py-2">
                {{ $typeOfMedia }} genres
            </a>
        </li>
    </ul>
</div>