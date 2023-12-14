<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $addressModel;

    public function __construct()
    {
        $this->addressModel = new Address();
    }

    public function index()
    {
        $cart = Cart::instance('cart')->content();
        return view('user.cart.index', compact('cart'));
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

    public function checkout()
    {
        $cart = Cart::instance('cart')->content();
        $id = Auth::user()->getAuthIdentifier();
        $addresses = User::find($id)->addresses->toArray();
        return view('user.cart.checkout', compact('cart', 'addresses'));
    }
}
