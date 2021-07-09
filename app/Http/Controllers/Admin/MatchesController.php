<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatchRequest;
use App\Match;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('played') == '1') {
        $data = Match::where('start', '<', Carbon::now()->addDay())->orderBy('start', 'desc')->paginate(20);
        } else {
            $data = Match::orderBy('id', 'desc')->where('start', '>', now())->where('start', '<', now()->addDays(15))->paginate(20);
        }
        $next = Match::where([['show', '>', 0], ['start', '>', Carbon::now()->addHours(-3)]])->orderBy('start', 'ASC')->limit(15)->get();

        $last = Match::where('winner', '<', 1)->where('start', '<', Carbon::now())->orderBy('start')->paginate(20);
        return view('admin.matches.index', compact('data', 'last', 'next'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Match::findOrFail($id);
        $cross = Match::where([['start', '<', $data->start], ['host_team', $data->host_team], ['guest_team', $data->guest_team]])->orWhere([['start', '<', $data->start], ['host_team', $data->guest_team], ['guest_team', $data->host_team]])->orderBy('start', 'desc')->limit(5)->get();
        $last_host = Match::where([['start', '<', $data->start], ['host_team', $data->host_team]])->orWhere([['start', '<', $data->start], ['guest_team', $data->host_team]])->orderBy('start', 'desc')->limit(5)->get();
        $last_guest = Match::where([['start', '<', $data->start], ['host_team', $data->guest_team]])->orWhere([['start', '<', $data->start], ['guest_team', $data->guest_team]])->orderBy('start', 'desc')->limit(5)->get();
        return view('admin.matches.show', compact('data', 'cross', 'last_host', 'last_guest'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $teams = Team::where('tournament_id', '=', 1);
        return view('admin.matches.create', compact('teams'));
    }


    function pratelske_url($nazev) {
    $url = $nazev;
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
    return $url;
}
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchRequest $request)
    {
        try {
            $stream_url = $this->pratelske_url(Team::findOrFail($request->get('host_team'))->name);
            $stream_url_final = "https://nhl-stream.com/live/$stream_url-live-stream/channel-1/";
            $match = Match::insertGetId([
                'start' => Carbon::parse($request->get('start')),
                'host_team' => $request->get('host_team'),
                'guest_team' => $request->get('guest_team'),
                'week' => $request->get('week'),
                    'stream_url' => $stream_url_final,
            ]);
            Log::info('Pridan zapas: ' . $match, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.zapasy.index'))->with('success', 'Zápas přidán!');
        } catch (\Exception $e) {
            return redirect(route('admin.zapasy.index'))->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $match = Match::findOrFail($id);
            $teams = Team::where('tournament_id', '=', 1);
        } catch (\Exception $e) {
            return redirect(route('admin.zapasy.index'))->with('error', $e->getMessage());
        }
        return view('admin.matches.edit', compact('match', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatchRequest $request, $id)
    {
        $request->validate([
            'start' => 'required',
            'host_team' => 'required',
            'guest_team' => 'required',
            'week' => 'required',
        ]);

        try {
            $match = Match::findOrFail($id);
            $match->start = $request->get('start');
            $match->host_team = $request->get('host_team');
            $match->guest_team = $request->get('guest_team');
            $match->tournament_id = $request->get('tournament_id');
            $match->descriptions = $request->get('descriptions');
            $match->winner = $request->get('winner');
            $match->score_host = $request->get('score_host');
            $match->score_guest = $request->get('score_guest');
            $match->stream_url = $request->get('stream_url');
            $match->week = $request->get('week');
            $match->save();

            $match->evaluteTips();
            Log::info('Zapas upraven ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.zapasy.show', $match->id))->with('success', 'Zapas upraven!');
        } catch (\Exception $e) {
            return redirect(route('admin.zapasy.show', $match->id))->with('error', $e->getMessage());
        }
    }

    public function restore(Request $request, $id)
    {
        try {
            Match::withTrashed()->find($id)->restore();
            Log::info('Zapas obnoven ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.zapasy.index'))->with('success', 'Zapas obnoven!');
        } catch (\Exception $e) {
            return redirect(route('admin.zapasy.index'))->with('error', $e->getMessage());
        }
    }

    public function setWinner(Request $request, Match $match)
    {
        $request->validate([
            'winner' => 'required',
        ]);
        $match->winner = $request->get('winner');
        $match->save();
        $match->evaluteTips();

        return back()->with('success', 'Zápas vyhodnocen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Match::findOrFail($id)->delete();
            Log::info('zapas smazan ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
        } catch (\Exception $e) {
            return redirect(route('admin.zapasy.index'))->with('error', $e->getMessage());
        }
        return redirect(route('admin.zapasy.index'))->with('success', 'Zapasy smazán!');
    }
}
