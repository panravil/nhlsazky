<?php

namespace App\Http\Controllers;

use App\ContestTip;
use App\Match;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now(); //or initialize it any other way

        $matches = Match::where([['start', '>', Carbon::now()->addHours(-3)],['start', '<', Carbon::now()->addDay(2)], ['winner', '=',  null]])->limit(13)->get();
        $users = DB::table('users')
            ->join('contest_tips', 'users.id', '=', 'contest_tips.user_id')
            ->selectRaw('nhl_users.id,nhl_users.name, COUNT(nhl_contest_tips.match_id) as total, SUM(nhl_contest_tips.result > 0) as good, SUM(nhl_contest_tips.result < 0) as bad, SUM(nhl_contest_tips.result) as body')

            ->groupBy('users.id', 'users.name')
            ->orderByDesc('body')
            ->get();
        return view('front.competition.competition', compact('matches', 'users'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('name', '=', $id)->firstOrFail();
        return view('front.competition.usertips', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function contestTip($match, $tip)
    {
        $user = Auth::user();
        $zapas = Match::findOrFail($match);

        if (\Carbon\Carbon::now() < $zapas->start) {
            $row_uz = $zapas->contestTips->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->first();
            if ($row_uz) {
                return back()->with('error', "Na tento zápas již máte vsazeno!");
            } else {
                $contesttip = ContestTip::create([
                    'datum' => Carbon::now(),
                    'user_id' => Auth::user()->id,
                    'match_id' => $match,
                    'tip' => $tip
                ]);
                if (!$contesttip) {
                    return back()->with('error', "Zkuste to prosím později, nebo kontaktujte webmastra.");
                } else {
                    return redirect('/soutez/#'.$match)->with('success', "Úspěšně tipováno.");
                }
            }
        } else {
            return back()->with('error', "Již nelze tipovat, zápas probíhá!");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
