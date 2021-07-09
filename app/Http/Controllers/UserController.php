<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function account()
    {
        return view('front.account.account');
    }

    public function edit(Request $request)
    {
        return view('front.account.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|email'
        ]);
        Auth::user()->email = $request->get('email');
        Auth::user()->email_verified_at = null;
        Auth::user()->save();
        try {
            Auth::user()->sendEmailVerificationNotification();
        } catch (\Exception $e) {

        }
        return redirect(route('account'))->with('success', 'Email upraven');
    }

    public function updateNotification(Request $request)
    {
        Auth::user()->notifications = $request->notifications;
        Auth::user()->save();
        return back()->with('success', 'Hotovo');
    }

    public function updateNewsletter(Request $request)
    {
        Auth::user()->newsletter = $request->newsletter;
        Auth::user()->save();
        return back()->with('success', 'Hotovo');
    }
}
