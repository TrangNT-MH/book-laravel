<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Claims\Collection;

class BookController extends Controller
{
//    protected Book $bookModel;
//    public function __construct()
//    {
//        $this->bookModel = new Book();
//    }
//
//    public function index()
//    {
////        $book = Book::all()->paginate();
//        return BookResource::collection(Book::paginate());
//
//    }
//
//    public function store(AddBookRequest $request)
//    {
//        $validator = $request->validated();
//        $book  = Book::create($validator);
//
//        return $this->wrapResponse(Response::HTTP_OK, 'Success', $book);
//    }

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

            $query->where(function ($query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhere('title', 'like', '%' . $key . '%');
                }
            });
        }

        $allBooks = $query->paginate($perPage);

        return BookResource::collection($allBooks);
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

            $book = Book::create($validatedData);

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
        $selectBook = $this->bookModel->find($id);

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

    public function destroy($id)
    {
        $selectBook = $this->bookModel->find($id);

        if (!$selectBook) {
            return response()->json([
                'error' => 'Book not found'
            ], 404);
        }

        Storage::delete($selectBook->image);
        $selectBook->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }

}
