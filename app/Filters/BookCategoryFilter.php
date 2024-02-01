<?php

namespace App\Filters;


class BookCategoryFilter
{
    public function __invoke($query, $category)
    {
        return $query->join('book_genres', 'books.id', '=', 'book_genres.book_id')
            ->join('genres', 'book_genres.genre_id', '=', 'genres.id')
            ->join('categories', 'genres.category_id', '=', 'categories.id')
            ->where('categories.category', $category);
    }
}
