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
    private string $url;
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

    public function getEndPoint()
    {
        $this->url = isset($this->param)
            ? str_replace('{$param}', $this->param, $this->endPoint)
            : $this->endPoint;

        return $this->url;
    }
}
