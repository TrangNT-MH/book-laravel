<?php

namespace App\Http\Controllers\User;

use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use function PHPUnit\Framework\containsIdentical;

class BookController extends Controller
{
    function index(BookFilter $filter)
    {
        $perPage  = request()->get('limit', 20);
        $books = Book::filter($filter)->paginate($perPage);
        return view('user.book.index', compact('books'));
    }

    function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            dd($id);
        }
//        $book = Book::find($id);
//        Cart::add([
//            'id' => $id,
//            'title' => $book->title,
//            'authors' => $book->authors,
//            'price' => $book->price
//        ]);
    }

    function cart()
    {
        $cart = Cart::content();
        return view('user.book.cart', compact('cart'));
    }
}
