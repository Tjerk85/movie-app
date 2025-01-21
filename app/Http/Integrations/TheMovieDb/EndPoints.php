<?php

namespace App\Http\Integrations\TheMovieDb;

class EndPoints
{
    public static $MOVIEREQUEST = '/movie/{$param}';

    public static $SIMILARMOVIEREQUEST = '/movie/{$param}/similar?language=en-US&page=1';

    public static $POPULARMOVIEREQUEST = '/movie/popular?language=en-US';

    public static $TOPRATEDMOVIEREQUEST = '/movie/top_rated?language=en-US';

    public static $TRENDINGMOVIEREQUEST = '/trending/movie/{$param}?language=en-US';

    public static $SERVICESTOWATCHMOVIEREQUEST = '/movie/{$param}/watch/providers';

    public static $ONTHEAIRTVSHOWSREQUEST = '/tv/on_the_air?language=en-US';

    public static $POPULARTVSHOWSREQUEST = '/tv/popular?language=en-US&page=1';

    public static $TOPRATEDTVSHOWSREQUEST = '/tv/top_rated?language=en-US';

    public static $SIMILARTVSHOWSREQUEST = '/tv/{$param}/similar?language=en-US&page=1';

    public static $TVSHOWREQUEST = '/tv/{$param}?language=en-US';

    public static $MOVIEGENREREREQUEST = '/genre/movie/list';

    public static $TVSHOWGENREREQUEST = '/genre/tv/list';

    public static $ACTORSMOVIEREQUEST = '/movie/{$param}/credits';

    public static $ACTORSRELATEDTOTVSHOWREQUEST = '/tv/{$param}/credits';

    public static $ACTORREQUEST = '/person/{$param}?append_to_response=images,movie_credits,tv_credits';

    public static $POPULARACTORREQUEST = '/person/popular';

    /* {$param} is day ore week */
    public static $TRENDINGACTORREQUEST = '/trending/person/{$param}';

    public static $ACTORRELATEDTOMOVIEREQUEST = '/find/{$param}?external_source=imdb_id';

    public static $SEARCHQUERYREQUEST = '/search/multi?query={$param}&include_adult=true&language=en-US&page=1';

    private string $endPoint;

    private string $param;
    /**
     * @var int|mixed
     */
    private mixed $page;

    public function __construct() {}

    public function set($endPoint, $param = '', $page = 1)
    {
        $this->endPoint = $endPoint;
        $this->param = $param;
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
        return isset($this->param)
            ? str_replace('{$param}', $this->param, $this->endPoint)
            : $this->endPoint;
    }
}
