<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository
{

    public function getModel()
    {
        return Category::class;
    }

    public function allID()
    {
        return $this->model->pluck('id')->toArray();
    }

    public function name($id)
    {
        return $this->model->find($id)->category;
    }
}