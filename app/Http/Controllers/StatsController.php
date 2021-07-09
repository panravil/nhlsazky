<?php

namespace App\Http\Controllers;

use App\Package;
use App\Stat;
use App\Ticket;

class StatsController extends Controller
{
    public function globalStats()
    {
        return view('front.stats.globalstats');
    }

    public function packageStats($typ)
    {
        $package = Package::where('seo', '=', $typ)->firstOrFail();
        $stats = $package->stats->where('seo', '=', 'celkove-obdobi')->sortByDesc('season');
        if ($package->id != 4) {
            $tickets_old = Ticket::where('package_id', $package->id)->where('status', '!=', 0)->orderBy('created_at', 'desc')->paginate();
            $tickets = Ticket::where('package_id', $package->id)->where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        } else {
            $stats = Stat::where([['seo', '=', 'celkove-obdobi'], ['package_id', '=', 1]])->get()->sortByDesc('season');
            $tickets_old = Ticket::where('status', '!=', 0)->orderBy('created_at', 'desc')->paginate();
            $tickets = Ticket::where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        }
        return view('front.stats.packagestats', compact('typ', 'package', 'tickets', 'tickets_old', 'stats'));
    }

    public function detailStats($typ, $sezona, $obdobi)
    {
        $package = Package::where('seo', '=', $typ)->firstOrFail();
        if ($package->id != 4) {

            $stats_seasons = Stat::where([['seo', '=', 'celkove-obdobi'], ['package_id', '=', 1]])->get()->sortByDesc('season');
            $stats = $package->stats->where('season', '=', $sezona)->sortByDesc('from');
            $stat = $package->stats->where('season', '=', $sezona)->where('seo', '=', $obdobi)->first();
            $tickets = Ticket::whereBetween('created_at', [$stat->from, $stat->to])->where('package_id', $package->id)->where('status', '!=', 0)->orderBy('match_start', 'desc')->paginate(25);
        } else {

            $stats_seasons = Stat::where([['seo', '=', 'celkove-obdobi'], ['package_id', '=', 1]])->get()->sortByDesc('season');
            $stats = Stat::where([['season', '=', $sezona], ['package_id', '=', 1]])->get()->sortByDesc('from');
            $stat = Stat::where([['season', '=', $sezona], ['package_id', '=', 1], ['seo', '=', $obdobi]])->get()->first();
            $tickets = Ticket::whereBetween('created_at', [$stat->from, $stat->to])->where('status', '!=', 0)->orderBy('match_start', 'desc')->paginate(25);
        }
        return view('front.stats.detailstats', compact('typ', 'sezona', 'obdobi', 'package', 'stats' ,'stats_seasons', 'stat', 'tickets'));
    }
}
