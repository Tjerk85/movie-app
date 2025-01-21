<?php

namespace App\Services;

use App\Abstracts\TypeOfMedia;
use App\Http\Integrations\TheMovieDb\Requests\SearchMultiRequest;

class SearchMultiService extends TypeOfMedia
{
    public function __construct(public mixed $input)
    {
        parent::__construct();
    }

    public function searchQuery()
    {
        return $this->connector->send(new SearchMultiRequest(
            $this->endPoints
                ->set($this->endPoints::$SEARCHQUERYREQUEST, $this->input)
                ->getEndPoint(),
            'results'
        ))->dto();
    }
}
