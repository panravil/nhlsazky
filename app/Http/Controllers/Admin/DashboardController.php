<?php

namespace App\Http\Controllers\Admin;

use App\Charts\admin\PackageDistribution;
use App\Charts\admin\UsersRegistrations;
use App\Http\Controllers\Controller;
use App\Match;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart = new UsersRegistrations();
        $chart2 = new PackageDistribution();
        $ticketsLive = Ticket::where('status', '<', 1)->where('show', '=', 1)->orderBy('created_at', 'desc')->get();
        $nextMatches = Match::where([['show', '>', 0], ['start', '>', Carbon::now()->addHours(-3)]])->orderBy('start', 'ASC')->limit(15)->get();
        $lastDoneMatches = Match::where([['show', '>', 0], ['start', '>', Carbon::now()->addHours(3)]])->orderBy('start', 'asc')->limit(15)->get();
        return view('admin/dashboard/index', compact('chart', 'chart2', 'nextMatches', 'lastDoneMatches', 'ticketsLive'));
    }

    public function notFound()
    {
        return response()->view('admin.error', [], 404);
    }
}
