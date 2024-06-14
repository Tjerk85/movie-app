<?php
//Tinker away!
$connector = new \App\Http\Integrations\TheMovieDb\TheMovieDbConnector();
$request = new \App\Http\Integrations\TheMovieDb\Requests\PopularTvShowsRequest();
//$request = new \App\Http\Integrations\themoviedb\Requests\TvGenresRequest();

$response = $connector->send($request);

///** @var \Illuminate\Support\Collection $data */
$data = $response->json();

return $data;
