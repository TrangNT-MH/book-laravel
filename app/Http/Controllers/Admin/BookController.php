<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\BookGenreRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GenreRepository;
use Exception;
use http\Message;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use function MongoDB\BSON\toJSON;

class BookController extends Controller
{
    protected BookRepository $bookRepository;
    protected CategoryRepository $categoryRepository;
    protected GenreRepository $genreRepository;
    protected BookGenreRepository $bookGenreRepository;


    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->genreRepository = new GenreRepository();
        $this->bookGenreRepository = new BookGenreRepository();
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
        $allGenres = $this->categoryRepository->genres();

        return view('admin.book.store', compact('allGenres'));
    }

    public function store(AddBookRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'isbn' => $request->isbn,
                'title' => $request->title,
                'authors' => $request->authors,
                'price' => $request->price,
                'description' => $request->description,
                'publisher' => $request->publisher,
                'page_count' => $request->page_count,
                'publish_date' => $request->publish_date,
                'language' => $request->language,
                'image' => $request->image
            ];

            $image = $request->file('image');

            $data['image'] = $this->getImage($image);

            $id = $this->bookRepository->create($data);

            $genres = $request->genres;

            foreach($genres as $key => $genre_id)
            {
                $this->bookGenreRepository->create([
                    'book_id' => $id,
                    'genre_id' => $genre_id
                ]);
            }

            DB::commit();

            return redirect()->route('admin.book.index');
        } catch (Exception $e) {
            Storage::delete($data['image']);
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $selectBook = $this->bookRepository->detail($id);
        $allGenres = $this->categoryRepository->genres();

        $genresOfBook = $this->bookRepository->genres($id);
        return view('admin.book.detail', compact('selectBook', 'allGenres', 'genresOfBook'));
    }

    public function edit(UpdateBookRequest $request)
    {
        $data = [
            'isbn' => $request->isbn,
            'title' => $request->title,
            'authors' => $request->authors,
            'price' => $request->price,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'page_count' => $request->page_count,
            'publish_date' => $request->publish_date,
            'language' => $request->language,
            'image' => $request->image
        ];

        $genres = $request->geners;

        if (isset($validatedData['image'])) {
            $data['image'] = $this->getImage($request->file('image'));
        }

        try {
            DB::beginTransaction();

            $this->bookRepository->update($request->id, $data);


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
