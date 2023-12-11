<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::instance('cart')->content();
        return view('user.book.cart', compact('cart'));
    }

    public function delete($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('user.cart');
    }

    public function update($rowId, Request $request)
    {
        $qty = $request->get('qty');
        Cart::instance('cart')->update($rowId, ['qty' => $qty]);
    }
}
