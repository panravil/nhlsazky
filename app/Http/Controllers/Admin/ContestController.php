<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
use App\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')
            ->join('contest_tips', 'users.id', '=', 'contest_tips.user_id')
            ->selectRaw('nhl_users.id,nhl_users.name, COUNT(nhl_contest_tips.match_id) as total, SUM(nhl_contest_tips.result > 0) as good, SUM(nhl_contest_tips.result < 0) as bad, SUM(nhl_contest_tips.result) as body')

            ->groupBy('users.id', 'users.name')
            ->orderByDesc('body')
            ->paginate(30);
        return view('admin.contest.contest', compact('data'));
    }


    public function endContest()
    {

    }

    public function checkContest()
    {
        $dt = Carbon::now(); //or initialize it any other way
        $matches = Match::where([['week', '=', $dt->copy()->week()], ['winner', '=', 0], ['start', '>', Carbon::now()->addWeeks(-1)]])->get();
        $users = DB::table('users')
            ->join('contest_tips', 'users.id', '=', 'contest_tips.user_id')
            ->selectRaw('nhl_users.id,nhl_users.name, COUNT(nhl_contest_tips.match_id) as total, SUM(nhl_contest_tips.result > 0) as good, SUM(nhl_contest_tips.result < 0) as bad, SUM(nhl_contest_tips.result) as body')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('body')
            ->get();
        $tariffs = Tariff::all();
        return view('admin.contest.contest', compact('users'));
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
