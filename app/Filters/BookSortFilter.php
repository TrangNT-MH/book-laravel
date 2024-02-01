<?php

namespace App\Filters;

class BookSortFilter
{
    public function __invoke($query, $sort)
    {
        if ($sort == 'asc') {
            $query->orderBy('price', 'asc');
        }
        if ($sort == 'desc') {
            $query->orderBy('price', 'desc');
        }
        return $query;
    }
}
