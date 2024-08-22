<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticated(Request $request, $user)
    {
        if ($user->role === 'Admin') {
            return redirect()->route('admin.home');
        } elseif ($user->role === 'Kasipem') {
            return redirect()->route('kasipem.home');
        } else {
            return redirect()->route('user.home');
        }
    }
}