<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use App\Repositories\AddressRepository;
use App\Repositories\UserRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected AddressRepository $addressRepository;
    protected UserRepository $userRepository;

    public function __construct(AddressRepository $addressRepository, UserRepository $userRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->userRepository = $userRepository;
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
        $addresses = $this->userRepository->addresses($id);
        return view('user.cart.checkout', compact('cart', 'addresses'));
    }

    public function storeAddress(AddressRequest $request)
    {
        $id = Auth::user()->getAuthIdentifier();
        $data = [
            "user_id" => $id,
            "address_detail" => trim($request->address_detail),
            "ward" => trim($request->ward),
            "district" => trim($request->district),
            "province" => trim($request->province),
            "is_default" => $request->is_default ? 1 : 0
        ];
        try {
            if ($request->is_default == 1) {
                $this->addressRepository->updateDefault($id);
            }
            Address::updateOrCreate($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect()->back();
    }

    public function delAddress($id, Request $request)
    {
        if ($request->ajax()) {
            Address::destroy($id);
        }
    }

}
