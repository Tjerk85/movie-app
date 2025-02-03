<nav class="border-b border-gray-700 z-20">
    <ul class="max-w-full md:ml-20 md:mr-20 flex flex-wrap items-center justify-between mx-auto p-4">
        <li class="group relative dropdown px-4 cursor-pointer font-bold text-base uppercase tracking-wide">
            <a href="{{ route('home') }}">Movies</a>
            <x-dropdown-menu :typeOfMedia="'movie'" />
        </li>
        <li class="group relative dropdown px-4 cursor-pointer font-bold text-base uppercase tracking-wide">
            <a href="{{ route('tv') }}">Tv</a>
            <x-dropdown-menu :typeOfMedia="'tv'" />
        </li>
        <li class="font-bold text-base uppercase tracking-wide">
            <a href="{{ route('actors') }}">Actors</a>
        </li>
        <li><livewire:search-multi /></li>
    </ul>
</nav>
