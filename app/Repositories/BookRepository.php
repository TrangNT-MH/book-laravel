<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository extends EloquentRepository
{
    public function getModel()
    {
        return Book::class;
    }

    public function detail($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function updateStatus($id, $newStatus)
    {
        return $this->model->where('id', $id)
            ->update(['status' => $newStatus]);
    }
}
