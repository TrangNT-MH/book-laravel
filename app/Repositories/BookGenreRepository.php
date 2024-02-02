<?php

namespace App\Repositories;

use App\Models\BookGenres;

class BookGenreRepository extends EloquentRepository
{

    function getModel()
    {
        return BookGenres::class;
    }
}
