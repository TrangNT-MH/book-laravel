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
//        $book = new Book();
////        dd($book);
//        try {
//            $book->create($data);
//        } catch (\Exception $exception) {
//            dd($exception->getMessage());
//        }
////        $book->save($data);
////        dd($data);
        return $this->model->create([
            'isbn' => $data['isbn'],
            'title' => $data['title'],
            'authors' => $data['authors'],
            'price' => $data['price'],
            'description' => $data['description'],
            'publisher' => $data['publisher'],
            'page_count' => $data['page_count'],
            'publish_date' => $data['publish_date'],
            'language' => $data['language'],
            'image' => $data['image']
        ]);
    }

    public function categories()
    {
        return $this->model->with('genre')->pluck('genre')->get()->toArray();
    }
}
