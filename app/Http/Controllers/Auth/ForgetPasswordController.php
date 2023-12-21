<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    protected $user;
    protected $passwordResetToken;

    public function __construct()
    {
        $this->user = new User();
        $this->passwordResetToken = new PasswordResetToken();
    }
    public function forgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    public function sendLink(EmailForgetPasswordRequest $request)
    {

        $token = md5(uniqid($this->user->findByEmail($request->email), true));
        $email = $request->email;

        $data = ([
            'email' => $email,
            'token' => $token
        ]);

        PasswordResetToken::insert($data);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('password.resend.request', $token);
    }

    public function resetPasswordForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        DB::transaction(function () use ($request) {
            $email = $this->passwordResetToken->find($request->token);
            $this->user->updatePassword($email, Hash::make($request->password));
            $this->passwordResetToken->deleteByToken($email, $request->token);
        });

        return redirect()->route('login');
    }

    public function resendRequest($token)
    {
        return view('auth.reset-request', compact('token'));
    }

    public function resend(Request $request)
    {
        $email = $this->passwordResetToken->find($request->token);
        if ($email) {
            $this->passwordResetToken->deleteByToken($email, $request->token);
        }

        $token = md5(uniqid($this->user->findByEmail($email), true));

        $data = ([
            'email' => $email,
            'token' => $token
        ]);

        PasswordResetToken::insert($data);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use ($email){
            $message->to($email);
            $message->subject('Reset Password');
        });
        return redirect()->route('password.resend.request', $token)
            ->withSuccess('Have already send a request password link successfully');
    }
}
