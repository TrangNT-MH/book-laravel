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

    public function allBook($genre)
    {
        return $this->model->with('books')->find($genre)->books->toArray();
    }

    public function genres()
    {
        return $this->model->with('categories')->get();
    }

    public function findId($genres)
    {
        return $this->model->where('genres', $genres)->first()->id;
    }
}
