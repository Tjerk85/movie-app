<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchMultiService;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $results = new SearchMultiService($request->input('search'));
        return $results->searchQuery();
    }
}
