<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Exception;
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

        $status = $request->get('is_active');
        $keys = $request->get('key');
        $perPage = $request->get('limit', 5);

        $query = Book::query();

        if ($status == 1) {
            $query->where('status', '1');
        }

        if ($keys) {
            if (!is_array($keys)) {
                $keys = explode(' ', $keys);
            }

            $query->where(function (Builder $query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhere('title', 'like', '%' . $key . '%');
                }
            });
        }

        $allBooks = $query->paginate($perPage);

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

            $validatedData['image'] = $this->getImage($image);

            $this->bookModel->insert($validatedData);

            return redirect()->route('admin.book.index');
        } catch (Exception $e) {
            Storage::delete($validatedData['image']);
            return Redirect::back()->with('error', 'Having an error when adding the book: ' . $e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $selectBook = $this->bookModel->detail($id);
        return view('admin.book.detail', compact('selectBook'));
    }

    public function edit(UpdateBookRequest $request)
    {
        $selectBook = Book::findOrFail($request->id);
        $validatedData = $request->validated();

        $selectBook->title = $validatedData['title'];
        $selectBook->author = $validatedData['author'];
        $selectBook->isbn10 = $validatedData['isbn10'];
        $selectBook->price = $validatedData['price'];
        $selectBook->publication_date = $validatedData['publication_date'];

        if (isset($validatedData['image'])) {
            $selectBook['image'] = $this->getImage($request->file('image'));
        }

        try {
            if ($selectBook->save()) {
                return view('admin.book.detail', compact('selectBook'));
            }
        } catch (Exception $e) {
            Storage::delete($validatedData['image']);
            return back()->withInput()->withErrors(['error' => 'Update failed.']);
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $currentStatus = (int)$request->status;

        if ($currentStatus == 1) {
            $newStatus = 2;
        } else {
            $newStatus = 1;
        }
        $this->bookModel->where('id', $id)
                        ->update(['status' => $newStatus]);

        return redirect('admin/book/detail/' . $id);
    }

    public function getImage($image)
    {
        $path = public_path('storage/images/books');
        if (!file_exists($path)) {
            File::makeDirectory($path, '777', true);
        }

        $imageStoreName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/storage/images/books/'), $imageStoreName);

        return 'images/books/' . $imageStoreName;
    }
}
