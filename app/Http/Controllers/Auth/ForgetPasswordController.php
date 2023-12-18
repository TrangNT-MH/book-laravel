<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function forgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    public function sendLink(EmailForgetPasswordRequest $request)
    {
        $token = Str::random(64);

        $data = ([
            'email' => $request->email,
            'token' => $token
        ]);

        PasswordResetToken::insert($data);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('password.reset', $token);
    }

    public function resetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        dd($request->token);
    }
}
