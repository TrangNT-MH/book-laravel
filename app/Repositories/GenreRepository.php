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

    public function genres($cate_id)
    {
        return $this->model->where('category_id', $cate_id)->pluck('genres')->toArray();
    }
}
