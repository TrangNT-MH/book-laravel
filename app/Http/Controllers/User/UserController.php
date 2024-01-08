<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Mail\SendEmail;
use App\Repositories\UserInfoRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use MustVerifyEmail;
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

    public function updateProfile(ProfileRequest $request)
    {
        $id = $request->id;
        $data = [
            'phoneNumber' => $request['phoneNumber'],
            'gender' => $request['gender'],
            'dob' => $request['dob']
        ];
        try {
            DB::beginTransaction();

            $this->userRepository->update($id, [
                'name' => $request['name']
            ]);

            $this->userInfoRepository->update($id, $data);

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function changeEmail()
    {
        return view('user.user-info.change-email');
    }

    public function verifyEmailAgain(Request $request)
    {
        $user = auth()->user();

        $code = rand(100000, 999999);
        $id = $user->id;
        $newEmail = $request->validate([
            'email' => 'required|email|unique:users'
        ]);

        Mail::send('email.change-email', ['code' => $code], function($message) use ($newEmail){
            $message->to($newEmail);
            $message->subject('Verify Email');
        });

        return redirect()->route('user.verifyEmailCode', Hash::make($code));
    }

    public function verifyEmailCode(Request $request)
    {
        Session::put('code', $request->code);
        return view('email.verify-email.change');
    }

    public function checkEmailCode(Request $request)
    {
        $code = $request['code'];
        if (Hash::check($code, Session::get('code'))) {
            $this->userRepository->update(auth()->user()->id, [
            ]);
        }
    }
}
