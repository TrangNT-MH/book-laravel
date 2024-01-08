<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use App\Repositories\UserInfoRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class UserController extends Controller
{
    protected UserInfoRepository $userInfoRepository;
    protected UserRepository $userRepository;
    public function __construct()
    {
        $this->userInfoRepository = new UserInfoRepository();
        $this->userRepository = new UserRepository();
    }
    public function index()
    {

    }

    public function profile($id)
    {
        $user = $this->userInfoRepository->find($id)->users()->get()->first()->toArray();
        $userInfo = $this->userInfoRepository->find($id)->toArray();
        $addresses = $this->userRepository->addresses($id);
        return view('user.user-info.user-info', compact('user','userInfo', 'addresses'));
    }

    public function changPassword()
    {
        return view('user.user-info.change-password');
    }

    public function updateProfile(Request $request)
    {

    }
}
