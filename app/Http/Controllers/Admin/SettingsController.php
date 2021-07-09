<?php

namespace App\Http\Controllers\Admin;

use App\Chat;
use App\Http\Controllers\Controller;
use App\Match;
use App\Setting;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function enableLive(Request $request)
    {
        $settings = Setting::first();
        $settings->live_enable = 1;
        $settings->save();
        return back()->with('success', 'ok zapnuto');
    }

    public function disableLive(Request $request)
    {
        $settings = Setting::first();
        $settings->live_enable = 0;
        $settings->live_chat = 0;
        $settings->topbar_enable = 0;
        $settings->save();
        return back()->with('success', 'ok vypnuto');
    }

    public function enableChat(Request $request)
    {
        $settings = Setting::first();
        $settings->live_chat = 1;
        $settings->save();
        return back()->with('success', 'ok zapnuto');
    }

    public function disableChat(Request $request)
    {
        $settings = Setting::first();
        $settings->live_chat = 0;
        $settings->save();
        return back()->with('success', 'ok vypnuto');
    }

    public function showLive(Request $request)
    {
        $settings = Setting::first();
        $settings->live_show = 1;
        $settings->save();
        return back()->with('success', 'ok zapnuto');
    }

    public function hideLive(Request $request)
    {
        $settings = Setting::first();
        $settings->live_show = 0;
        $settings->save();
        return back()->with('success', 'ok vypnuto');
    }

    public function chatClear()
    {
        Chat::query()->delete();
        return 200;
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
}
