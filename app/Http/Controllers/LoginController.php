<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where([
            ['email', '=', $request->input('email')],
            ['password', '=', $request->input('password')],
        ])->first();

        if ($user) {
            Auth::login($user, true);
            return redirect('/');
        }

        return redirect()->back();
    }
}
