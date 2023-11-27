<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $bookModel = new Book();
        $book = $bookModel->list();
        return BookResource::collection($book);
    }

    public function store(AddBookRequest $request)
    {
        $validator = $request->validated();
    }
}
