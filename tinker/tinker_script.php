<?php
//Tinker away!
$connector = new \App\Http\Integrations\themoviedb\TheMovieDbConnector();
$request = new \App\Http\Integrations\themoviedb\Requests\PopularMoviesRequest();

$response = $connector->send($request);

///** @var \Illuminate\Support\Collection $data */
$data = $response->dto()->getMoviePoster();

return $data;

