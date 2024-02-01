<?php

namespace App\Filters;

class BookPriceFilter
{
    public function __invoke($query, $offset)
    {
        if ($offset) {
            $offset = explode('-', $offset);
            if (count($offset) > 1) {
                $query->whereBetween('price', [$offset[0], $offset[1]]);
            } else {
                $query->where('price', '>=', $offset[0]);
            }
        }
        return $query;
    }
}
