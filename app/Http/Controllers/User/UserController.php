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
    public function __construct()
    {
        $this->userInfoRepository = new UserInfoRepository();
    }
    public function index()
    {

    }

    public function profile($id)
    {
        $userInfo = $this->userInfoRepository->find($id)->toArray();
//        dd($userInfo);
        return view('user.user-info', compact('userInfo'));
    }
}
