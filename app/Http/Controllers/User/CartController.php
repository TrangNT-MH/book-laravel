<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::content();
        return view('user.book.cart', compact('cart'));
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        $cart = Cart::content();
        return view('user.cart', compact('cart'));
    }
}
