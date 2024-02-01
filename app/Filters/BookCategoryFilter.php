<?php

namespace App\Filters;


class BookCategoryFilter
{
    public function __invoke($query, $category)
    {
//        str_replace('-', ' ', $category);
        return $query->join('book_genre', 'books.id', '=', 'book_genre.book_id')
            ->join('genres', 'book_genre.genre_id', '=', 'genres.id')
            ->join('categories', 'genres.category_id', '=', 'categories.id')
            ->where('category', $category);
    }
}
