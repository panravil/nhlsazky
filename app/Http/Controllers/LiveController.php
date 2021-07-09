<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LiveController extends Contro
{
    public function index()
    {
        $nastaveni = Setting::first();
        return view('front.live.live', compact('nastaveni'));
    }

    public function liveTickets()
    {

    }

    public function chatPost(Request $request)
    {
        return Chat::create(['user_id' => Auth::user()->id,'text' => $request->get('message')]);
    }

    public function chat(Request $request)
    {
        $from = $request->get('from', null);
        if (is_null($from)) {
            $messages = Chat::latest()->take(10);
        } else {
            $messages = Chat::where('created_at', '>', $from);
        }
        return $messages->latest()->get();
    }
}
