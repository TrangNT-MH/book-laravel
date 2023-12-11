<?php

namespace App\Http\Controllers\User;

use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(BookFilter $filter)
    {
        $perPage  = request()->get('limit', 10);
        $books = Book::filter($filter)->paginate($perPage);
        return view('user.book.index', compact('books'));
    }

    public function addToCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $book = Book::findOrFail($id);
            Cart::instance('cart')->add([
                'id' => $id,
                'name' => $book->title,
                'qty' => 1,
                'price' => $book->price,
                'weight' => 0,
                'options' => [
                    'author' => $book->authors,
                    'image' => $book->image
                ]
            ]);
            return response()->json([
                'message' => 'Add to cart successfully'
            ]);
        }
    }

    public function detail($id)
    {
        $book = Book::find($id);
        return view('user.book.detail', compact('book'));
    }
}
