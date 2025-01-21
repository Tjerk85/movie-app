<nav class="border-b border-gray-700 z-20">
    <ul class="max-w-full md:ml-20 md:mr-20 flex flex-wrap items-center justify-between mx-auto p-4">
        <li><a href="{{ route('home') }}">Movies</a></li>
        <li><a href="{{ route('tv') }}">Tv</a></li>
        <li><a href="{{ route('actors') }}">Actors</a></li>
        <li>
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <input
                        type="text"
                        id="search"
                        name="search"
                        class="
                        bg-gray-950
                        border-gray-400
                        focus:bg-gray-600
                        border
                        text-gray-400
                        text-sm rounded-lg
                        focus:ring-red-500
                        focus:border-red-500
                        block
                        w-full
                        p-2.5
                        dark:bg-gray-700
                        dark:border-gray-600
                        dark:placeholder-gray-400
                        dark:text-white
                        dark:focus:ring-blue-500
                        dark:focus:border-blue-500
                           "
                        placeholder="E.g: Matrix reloaded"/>
            </form>
        </li>
    </ul>
</nav>
