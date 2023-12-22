<?php

namespace App\Http\Controllers\User;

use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Repositories\BookRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index(BookFilter $filter)
    {
        $perPage  = request()->get('limit', 10);
        $books = Book::filter($filter)->paginate($perPage);
        return view('user.book.index', compact('books'));
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
        if ($book->category !== 'none') {
            $arrCate = explode(',', $book->category);
        } else {
            $arrCate = [];
        }
        return view('user.book.detail', compact('book', 'arrCate'));
    }
}
