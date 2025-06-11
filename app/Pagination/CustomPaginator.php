<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{
    /**
     * Panggil method format kustom pada paginator.
     *
     * @return mixed
     */
    public function asCustomPaginate()
    {
        // Panggil helper atau logika format Anda di sini
        return \App\Helpers\RefactorPaginate::format($this);
    }
}
