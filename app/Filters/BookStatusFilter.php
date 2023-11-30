<?php
namespace App\Filters;

class BookStatusFilter
{
    public function __invoke($query, $is_active)
    {
        if ($is_active == 1) {
            $query->where('status', '1');
        } else {
            $query->where('status', '2');
        }
        return $query;
    }
}
