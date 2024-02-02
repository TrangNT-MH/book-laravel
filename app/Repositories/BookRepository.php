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

    public function create($data)
    {
        $book = $this->model->create($data);
        return $book->id;
    }

    public function genres($id)
    {
        return $this->model->find($id)->genres()->pluck('genres.id')->toArray();
    }
}
