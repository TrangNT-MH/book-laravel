<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Models\Book;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $keys = $request->get('key');
        $perPage = $request->get('limit', 5);

        if ($keys === null) {
            $allBooks = Book::paginate($perPage);
        } else {
            if (!is_array($keys)) {
                $keys = explode(' ', $keys);
            }

            $allBooks = Book::where(function (Builder $query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhere('title', 'like', '%' . $key . '%');
                }
            })->paginate($perPage);
        }

        if ($request->ajax()) {
            $output = '';
            if (count($allBooks) > 0) {
                $output = '<ul class="list-group-item-info">';
                foreach ($allBooks as $row) {
                    $output .= '<li class="list-group-item" data-book-id="' . $row->id . '">' .
                        '<div class="book-title">Title: <span class="text-gray font-italic">' . $row->title . '</div></span>' .
                        '<div class="book-author">Author: <span class="text-gray font-italic">' . $row->author . '</div></span>' .
                        '<div class="book-isbn10">ISBN10: <span class="text-gray font-italic">' . $row->isbn10 . '</div></span>' .
                        '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No results' . '</li>';
            }
            return $output;
        }

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

    public function detail(Request $request)
    {
        $id = $request->id;
        $selectBook = $this->bookModel->detail($id);
        return view('admin.book.detail', compact('selectBook'));
    }
}
