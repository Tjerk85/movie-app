<?php

namespace App\Http\Controllers;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;
use App\Http\Integrations\TheMovieDb\Requests\TvShows\GeneralTvShowRequest;
use App\Services\GenreService;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiscoverWithGenresController extends Controller
{
    private MovieService $movieService;
    private int $page;

    public function __construct()
    {
        $this->movieService = new MovieService();
        $this->page = request()->query->get('page', 1);
    }

    public function index(Request $request): View
    {
        $mediaTypes = ['movie', 'tv'];
        $typeOfMedia = $request->segment(2);

        if (!in_array($typeOfMedia, $mediaTypes)) {
            return view('partials.not-found', [
                'message' => 'Type of media not found',
            ]);
        }

        $genres = (new GenreService())->getGenres($typeOfMedia);

        return view('genres.genres', [
            'genres' => $genres,
            'typeOfMedia' => $typeOfMedia,
            'title' => 'Discover '.$typeOfMedia.' genres',
        ]);
    }

    public function byGenre(Request $request): View
    {
        $genreId = $request->segment(4);
        $typeOfMedia = $request->segment(2);
        $mediaType = 'movies';
        $typeOfMediaClass = GeneralMovieRequest::class;

        if ($typeOfMedia === 'tv') {
            $mediaType = 'tvShows';
            $typeOfMediaClass = GeneralTvShowRequest::class;
        }

        $discoverRequest = $this->movieService->getMedia(
            EndPoints::$DISCOVERREQUEST,
            $typeOfMediaClass,
            $this->page,
            [$typeOfMedia, $genreId],
        );

        $nameGenre = $request->segment(3);
        if (!isset($discoverRequest['media'])) {
            return view('partials.not-found', [
                'message' => 'Sorry no movies or tv series found with the genre: '.$nameGenre,
            ]);
        }

        return view('genres.genre-index', [
                $mediaType => $discoverRequest['media'],
                'paginator' => $discoverRequest['paginator'],
                'title' => 'Genre: '.$nameGenre,
            ]
        );
    }
}
