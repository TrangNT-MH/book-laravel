<?php

namespace App\Http\Controllers\User;

use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GenreRepository;
use Dflydev\DotAccessData\Data;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected BookRepository $bookRepository;
    protected GenreRepository $genreRepository;
    protected CategoryRepository $cateRepository;

    public function __construct(BookRepository $bookRepository, GenreRepository $genreRepository, CategoryRepository $cateRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->genreRepository = $genreRepository;
        $this->cateRepository = $cateRepository;
    }

    public function index(BookFilter $filter)
    {
        $perPage  = request()->get('limit', 10);
        $books = Book::filter($filter)->paginate($perPage);

        $allGenres = $this->cateRepository->genres();
        return view('user.book.index', compact('books', 'allGenres'));
    }

    public function filter(Request $request)
    {
        $url = request()->fullUrlWithQuery($request->except('_token'));
        return redirect()->to($url);
    }

    public function addToCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $book = $this->bookRepository->find($id);
            $qty = $request->get('qty') ?? 1;
            Cart::instance('cart')->add([
                'id' => $id,
                'name' => $book->title,
                'qty' => $qty,
                'price' => $book->price,
                'weight' => 0,
                'options' => [
                    'author' => $book->authors,
                    'image' => $book->image
                ]
            ]);
            return response()->json([
                'message' => 'Add to cart successfully',
                'cart' => Cart::instance('cart')->content()
            ]);
        }
    }

    public function detail($id)
    {
        $book = $this->bookRepository->find($id);

        $genres = $book->genres->toArray();

        $allGenres = $this->cateRepository->genres();
        return view('user.book.detail', compact('book', 'genres', 'allGenres'));
    }

//    public function category(Request $request)
//    {
//        $category = $request->category;
//        $id = $this->genreRepository->findId($category);
//        $book = $this->genreRepository->allBook($id);
////        dd($book);
//
//        $allGenres = $this->cateRepository->genres();
//        return view('user.book.category', compact('category', 'allGenres'));
//    }
}
