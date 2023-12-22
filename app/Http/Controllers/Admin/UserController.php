<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $userModel = new User();
        $allUser = $this->userRepository->all();
        return view('admin.index', compact('allUser'));
    }

    public function detail(Request $request)
    {
        $user = $this->userRepository->detail($request->id);
        return view('admin.detail', compact('user'));
    }

    public function search(Request $request)
    {
        $key = $request->get('key');
        $searchUser = $this->userRepository->find($key);

        return view('admin.search', compact('searchUser'));
    }
}
