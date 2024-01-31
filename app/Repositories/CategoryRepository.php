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

    public function genres()
    {
        $categoriesWithGenres = $this->model->with('genres')->get();

        $result = [];

        foreach ($categoriesWithGenres as $category) {
            $categoryName = $category->category;
            $genres = $category->genres->pluck('genres')->toArray();

            $result[$categoryName] = $genres;
        }

        return $result;
    }
}
