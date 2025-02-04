<?php

namespace App\Services;

use App\Abstracts\TypeOfMedia;
use App\Http\Integrations\TheMovieDb\Requests\Actors\ActorRequest;

class MovieService extends TypeOfMedia
{
    public function getActorsMovie($id, $limit = null)
    {
        return $this->connector
            ->send(new ActorRequest(
                $this->endPoints
                    ->set($this->endPoints::$ACTORSMOVIEREQUEST, [$id])
                    ->getEndPoint(),
                'cast'
            ))
            ->dto()
            ->take($limit);
    }
}
