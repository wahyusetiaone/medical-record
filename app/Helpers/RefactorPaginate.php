<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RefactorPaginate
{
    /**
     * Refactor the pagination structure to a custom format.
     *
     * @param LengthAwarePaginator $paginator
     * @return array
     */
    public static function format(LengthAwarePaginator $paginator): array
    {
        return [
            'content' => $paginator->items(),
            'totalPages' => $paginator->lastPage(),
            'totalElements' => $paginator->total(),
            'pageNumber' => $paginator->currentPage(),
            'pageSize' => $paginator->perPage(),
            'isFirst' => $paginator->onFirstPage(),
            'isLast' => $paginator->currentPage() === $paginator->lastPage(),
        ];
    }
}

