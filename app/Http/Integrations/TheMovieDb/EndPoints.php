<?php

namespace App\Http\Integrations\TheMovieDb;

class EndPoints
{
    static public $MOVIEREQUEST = '/movie/{$param}';
    static public $SIMILARMOVIEREQUEST = '/movie/{$param}/similar?language=en-US&page=1';
    static public $POPULARMOVIEREQUEST = '/movie/popular?language=en-US&page=1';
    static public $TOPRATEDMOVIEREQUEST = '/movie/top_rated?language=en-US';
    static public $TRENDINGMOVIEREQUEST = '/trending/movie/{$param}?language=en-US';
    static public $SERVICESTOWATCHMOVIEREQUEST = '/movie/{$param}/watch/providers';
    static public $ONTHEAIRTVSHOWSREQUEST = '/tv/on_the_air?language=en-US';
    static public $POPULARTVSHOWSREQUEST = '/tv/popular?language=en-US&page=1';
    static public $TOPRATEDTVSHOWSREQUEST = '/tv/top_rated?language=en-US';
    static public $SIMILARTVSHOWSREQUEST = '/tv/{$param}/similar?language=en-US&page=1';
    static public $TVSHOWREQUEST = '/tv/{$param}?language=en-US';
    static public $MOVIEGENREREREQUEST = '/genre/movie/list';
    static public $TVSHOWGENREREQUEST = '/genre/tv/list';
    private string $endPoint;
    private string $param;

    public function __construct()
    {
    }

    public function set($endPoint, $param = '')
    {
        $this->endPoint = $endPoint;
        $this->param    = $param;

        return $this;
    }

    public function getEndPoint(): string
    {
        return isset($this->param)
            ? str_replace('{$param}', $this->param, $this->endPoint)
            : $this->endPoint;
    }
}
