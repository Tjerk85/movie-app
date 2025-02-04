<?php

//Tinker away!
use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;

$connector = new \App\Http\Integrations\TheMovieDb\TheMovieDbConnector();
//$request = new \App\Http\Integrations\TheMovieDb\Requests\PopularTvShowsRequest();
//$request = new \App\Http\Integrations\themoviedb\Requests\TvGenresRequest();

//$response = $connector->send($request);

$endPoints = new EndPoints();

$data = $connector
    ->send(new GeneralMovieRequest(
        $endPoints->set($endPoints::$SIMILARMOVIEREQUEST, [313])
            ->getEndPoint(),
        'results'
    ))->dto()
    ->take(8);

//$data = $connector
//    ->send(new GeneralMovieRequest(
//        $endPoints->send($endPoints::$MOVIEREQUEST, 313)
//            ->getEndPoint()
//    ))->dto();

///** @var \Illuminate\Support\Collection $data */
//$data = $response->json();

return $data;
