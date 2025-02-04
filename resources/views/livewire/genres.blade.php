<div>
    @foreach($genres as $genre)
        <a href="{{ route('genre', ['typeOfMedia' => $typeOfMedia, 'genreName' => $genre->name, 'genreId' => $genre->id]) }}"
           class="text-sm block px-4 py-2 border-gray-800 border-b-2">
            {{ $genre->name }}
        </a>
    @endforeach
</div>
