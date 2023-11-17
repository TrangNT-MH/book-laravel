<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private Book $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function index()
    {
        $allBooks = $this->bookModel->all();
        return view('admin.book.index', compact('allBooks'));
    }

    public function create()
    {
        return view('admin.book.store');
    }

    public function store(AddBookRequest $request)
    {

    }
}
