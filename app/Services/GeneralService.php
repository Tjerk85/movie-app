<?php

namespace App\Services;

use Saloon\PaginationPlugin\PagedPaginator;

class GeneralService
{
    public function getPagination(PagedPaginator $results, $page): array
    {
        $currentPage = $results->getCurrentPage() + 1;
        return [
            'previousPage' => $currentPage > 1 ? $currentPage - 1 : null,
            'nextPage' => $currentPage === 1 || !($page >= 500) ? $currentPage + 1 : null,
            'currentPage' => $currentPage
        ];
    }
}
