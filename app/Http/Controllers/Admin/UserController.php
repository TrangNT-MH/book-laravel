<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $userModel = new User();
        $allUser = $userModel->all();
        return view('admin.index', compact('allUser'));
    }

    public function detail(Request $request)
    {
        $userModel = new User();
        $user = $userModel->detail($request->id);
        return view('admin.detail', compact('user'));
    }

    public function search(Request $request)
    {
        $userModel = new User();
        $key = $request->get('key');
        $searchUser = $userModel->find($key);

        return view('admin.search', compact('searchUser'));
    }
}
