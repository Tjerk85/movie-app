<?php

namespace App\Http\Integrations\TheMovieDb;

class EndPoints
{
    public static $MOVIEREQUEST = '/movie/{$1}';

    public static $SIMILARMOVIEREQUEST = '/movie/{$1}/similar?language=en-US&page=1';

    public static $POPULARMOVIEREQUEST = '/movie/popular?language=en-US';

    public static $TOPRATEDMOVIEREQUEST = '/movie/top_rated?language=en-US';

    public static $TRENDINGMOVIEREQUEST = '/trending/movie/{$1}?language=en-US';

    public static $SERVICESTOWATCHMOVIEREQUEST = '/movie/{$1}/watch/providers';

    public static $ONTHEAIRTVSHOWSREQUEST = '/tv/on_the_air?language=en-US';

    public static $POPULARTVSHOWSREQUEST = '/tv/popular?language=en-US&page=1';

    public static $TOPRATEDTVSHOWSREQUEST = '/tv/top_rated?language=en-US';

    public static $SIMILARTVSHOWSREQUEST = '/tv/{$1}/similar?language=en-US&page=1';

    public static $TVSHOWREQUEST = '/tv/{$1}?language=en-US';

    public static $MOVIEGENREREREQUEST = '/genre/movie/list';

    public static $TVSHOWGENREREQUEST = '/genre/tv/list';

    public static $ACTORSMOVIEREQUEST = '/movie/{$1}/credits';

    public static $ACTORSRELATEDTOTVSHOWREQUEST = '/tv/{$1}/credits';

    public static $ACTORREQUEST = '/person/{$1}?append_to_response=images,movie_credits,tv_credits';

    public static $POPULARACTORREQUEST = '/person/popular';

    /* {$1} is day ore week */
    public static $TRENDINGACTORREQUEST = '/trending/person/{$1}';

    public static $ACTORRELATEDTOMOVIEREQUEST = '/find/{$1}?external_source=imdb_id';

    public static $SEARCHQUERYREQUEST = '/search/multi?query={$1}&include_adult=true&language=en-US&page=1';

    public static string $DISCOVERREQUEST = '/discover/{$1}?include_adult=true&include_video=false&language=en-US&page=1&sort_by=popularity.desc&with_genres={$2}';

    public static string $GENREREQUEST = '/genre/{$1}/list?language=en';

    private string $endPoint;

    private array $params;
    /**
     * @var int|mixed
     */
    private mixed $page;

    public function set($endPoint, $params = [], $page = 1)
    {
        $this->endPoint = $endPoint;
        $this->params = $params;
        $this->page = $page;

        return $this;
    }

    public function getPage()
    {
        $this->endPoint = isset($this->page)
            ? str_replace('{$page}', $this->page, $this->endPoint)
            : $this->page;

        return $this;
    }

    public function getEndPoint(): string
    {
        $paramsToReplace = [];
        foreach ($this->params as $key => $param) {
            $paramsToReplace[] = '{$' . $key+1 . '}';
        }

        return isset($this->params)
            ? str_replace($paramsToReplace, $this->params, $this->endPoint)
            : $this->endPoint;
    }
}
