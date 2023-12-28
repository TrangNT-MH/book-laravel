<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GenreRepository;
use Exception;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use function MongoDB\BSON\toJSON;

class BookController extends Controller
{
    protected BookRepository $bookRepository;
    protected CategoryRepository $categoryRepository;
    protected GenreRepository $genreRepository;

    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository, GenreRepository $genreRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->genreRepository = $genreRepository;
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
                        '<div class="book-author">Author: <span class="text-gray font-italic">' . $row->authors . '</div></span>' .
                        '<div class="book-isbn10">ISBN10: <span class="text-gray font-italic">' . $row->isbn . '</div></span>' .
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
        $categoryIDs = $this->categoryRepository->allID();

        $allGenres = [];
        foreach ($categoryIDs as $id) {
            $allGenres[] = [
                'category' => $this->categoryRepository->name($id),
                'genres' =>   $this->genreRepository->genres($id)
                ];
        }

        return view('admin.book.store', compact('allGenres'));
    }

    public function store(AddBookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $image = $request->file('image');

            $validatedData['image'] = $this->getImage($image);

            $this->bookRepository->create($validatedData);

            return redirect()->route('admin.book.index');
        } catch (Exception $e) {
            Storage::delete($validatedData['image']);
            return Redirect::back()->with('error', 'Having an error when adding the book: ' . $e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $selectBook = $this->bookRepository->detail($id);
        return view('admin.book.detail', compact('selectBook'));
    }

    public function edit(UpdateBookRequest $request)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['image'])) {
            $validatedData['image'] = $this->getImage($request->file('image'));
        }

        try {
            $selectBook = $this->bookRepository->update($request->id, $validatedData);
            return redirect()->route('admin.book.detail', $request->id);
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
        $this->bookRepository->updateStatus($request->id, $newStatus);

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
