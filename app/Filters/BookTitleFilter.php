<?php

namespace App\Filters;

class BookTitleFilter
{
    public function __invoke($query, $keys)
    {
        if (!is_array($keys)) {
            $keys = explode(' ', $keys);
        }

        $query->where(function ($query) use ($keys) {
            foreach ($keys as $key) {
                $query->orWhere('title', 'like', '%' . $key . '%');
            }
        });
        return $query;
    }
}
