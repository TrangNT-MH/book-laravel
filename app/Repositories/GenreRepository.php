<?php

namespace App\Repositories;

use App\Models\Genre;
use App\Repositories\EloquentRepository;

class GenreRepository extends EloquentRepository
{

    function getModel()
    {
        return Genre::class;
    }

    public function genres()
    {
        return $this->model->with('categories')->get();
    }
}
