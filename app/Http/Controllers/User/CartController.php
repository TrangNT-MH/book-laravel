<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use stdClass;

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

    public function storeAddress(AddressRequest $request)
    {
        if($request->validated()->fails())
        {
            return false;
        } else {
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
                Address::updateDefault($id);
                Address::updateOrCreate($data);
//                return redirect()->back();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

    }

    public function delAddress($id, Request $request)
    {
        if ($request->ajax()) {
            Address::destroy($id);
        }
    }

}
