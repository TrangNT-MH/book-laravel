<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Repositories\ShoppingCartRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    protected $shoppingCartRepository;

    public function __construct(ShoppingCartRepository $shoppingCartRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
    }
    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        $user->assignRole('user');
        event(new Registered($user));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended('admin/dashboard');
            }

            $storedCart = $this->shoppingCartRepository->content(Auth::user()->getAuthIdentifier());

            $storedCart = unserialize($storedCart);

            if ($storedCart) {
                foreach ($storedCart as $item) {
                    Cart::instance('cart')->add([
                        'id' => $item->id,
                        'name' => $item->name,
                        'qty' => $item->qty,
                        'price' => $item->price,
                        'weight' => 0,
                        'options' => [
                            'author' => $item->options['author'],
                            'image' => $item->options['image']
                        ]
                    ]);
                }
            }

            return redirect()->intended('/book');
        }
        return back()->withErrors(['fail_login' => 'Your provided credentials do not match in our records'])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
//        dd(Cart::instance('cart')->content());
        Cart::instance('cart')->erase(Auth::user()->getAuthIdentifier());
        Cart::instance('cart')->store(Auth::user()->getAuthIdentifier());
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}
