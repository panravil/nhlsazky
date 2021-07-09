<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Match;
use App\Setting;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LiveController extends Controller
{
    public function index()
    {
        $nastaveni = Setting::first();
        return view('front.live.live', compact('nastaveni'));
    }

    public function liveStore(Request $request)
    {
        if (isset($request->match_id)) {
            $matchO = Match::findOrFail($request->get('match_id'));
            $match = $matchO->full_name;
            $match_start = $matchO->start;
        } else {
            $match = $request->get('match');
            $match_start = Carbon::parse($request->get('match_start'));
        }
        $ticket = Ticket::create([
            'type' => 1,
            'package_id' => 3,
            'show' => $request->get('show', null),
            'match_title' => $match,
            'match_id' => $request->get('match_id'),
            'match_start' => $match_start,
            'tournament_id' => 1,
            'tip' => $request->get('tip'),
            'odds' => $request->get('odds'),
            'cost' => $request->get('cost'),
        ]);
        return $ticket;
    }

    public function liveCheck(Request $request)
    {
        $matches = Match::where('start', '>', Carbon::now()->addHours(-3))->where('start', '<', Carbon::now()->addHour(3))->get();
        $from = $request->get('from', null);
        if (is_null($from)) {
            $messages = Chat::latest()->take(10);
        } else {
            $messages = Chat::where('created_at', '>', $from);
        }
        return $messages->latest()->get();
    }


    public function liveUpdate(Request $request)
    {

    }

    public function liveDelete(Request $request)
    {
        return Ticket::findOrFail($request->ticket)->delete();
    }

    public function chatPost(Request $request)
    {
        return Chat::create(['user_id' => Auth::user()->id, 'text' => $request->get('message')]);
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
