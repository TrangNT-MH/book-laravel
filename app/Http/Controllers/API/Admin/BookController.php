<?php

namespace App\Http\Controllers\API\Admin;

use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index(BookFilter $filter)
    {
        $perPage = request()->get('limit', 5);

        $allBooks = Book::filter($filter)->paginate($perPage);

        return new BookCollection($allBooks);
    }

    public function create()
    {

    }

    public function store(AddBookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $image = $request->file('image');

            $validatedData['image'] = $this->getImage($image);

            $book = $this->bookRepository->create($validatedData);

            return new BookResource($book);
        } catch (\Exception $e) {
            Storage::delete($validatedData['image']);
            return response()->json([
                'error' => 'Error adding the book: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        $selectBook = $this->bookRepository->find($id);

        if (!$selectBook) {
            return response()->json([
                'error' => 'Book not found'
            ], 404);
        }

        return new BookResource($selectBook);
    }

    public function edit(UpdateBookRequest $request)
    {
        $selectBook = Book::findOrFail($request->id);

        $validatedData = $request->validated();

        $selectBook->update($validatedData);

        if (isset($validatedData['image'])) {
            $selectBook->image = $this->getImage($request->file('image'));
            $selectBook->save();
        }

        return new BookResource($selectBook);
    }

    public function updateStatus(Request $request)
    {
        $selectBook = Book::findOrFail($request->id);
        $currentStatus = (int)$request->status;

        if (!$selectBook) {
            return response()->json([
                'error' => 'Book not found'
            ], 404);
        }

        $action = 'deactivated';

        if ($currentStatus == 1) {
            $newStatus = 2;
        } else {
            $newStatus = 1;
            $action = 'activated';
        }
        $this->bookRepository->updateStatus($request->id, $newStatus);

        return response()->json([
            'message' => 'Book was ' . $action . ' successfully',
            'data' => new BookResource($selectBook)
        ]);
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
