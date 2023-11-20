<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    private Book $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function index()
    {
        $allBooks = Book::all();
        return view('admin.book.index', compact('allBooks'));
    }

    public function create()
    {
        return view('admin.book.store');
    }

    public function store(AddBookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $image = $request->file('image');

            $path = public_path('storage/images/books');
            if (!file_exists($path)) {
                File::makeDirectory($path, '777', true);
            }

            $imageStoreName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/books/'), $imageStoreName);

            $validatedData['image'] = 'images/books/' . $imageStoreName;

            $this->bookModel->insert($validatedData);

            return redirect()->route('admin.book.index');
        } catch (\Exception $e) {
            Storage::delete('images/books/' . $imageStoreName);
            return Redirect::back()->with('error', 'Having an error when adding the book: ' . $e->getMessage());
        }
    }
}
