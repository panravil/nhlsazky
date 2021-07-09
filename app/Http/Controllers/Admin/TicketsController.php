<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
use App\Notifications\PackageNotification;
use App\Package;
use App\Team;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class TicketsController extends Controller
{
    private function checkTicket(Ticket $ticket)
    {

        if ($ticket->status == 1) {
            $ticket->profit = ($ticket->cost * ($ticket->odds - 1));
            $ticket->save();
        }
        if ($ticket->status == 2) {
            $ticket->profit = -$ticket->cost;
            $ticket->save();
        }
        if ($ticket->status == 0) {
            $ticket->profit = ($ticket->cost * ($ticket->odds - 1));
            $ticket->save();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('package') != null) {
            $ticketsLive = Ticket::where('status', '<', 1)->where('show', '=', 1)->where('package_id', '=', $request->get('package'))->orderBy('created_at', 'desc')->paginate(10, ['*'], 'live');
            $ticketsDone = Ticket::where('status', '>', 0)->where('show', '=', 1)->where('package_id', '=', $request->get('package'))->orderBy('created_at', 'desc')->paginate(10, ['*'], 'done');
            $ticketsHidden = Ticket::where('show', '=', 0)->where('package_id', '=', $request->get('package'))->orderBy('created_at', 'desc')->paginate(10, ['*'], 'hidden');
        } else {
            $ticketsLive = Ticket::where('status', '<', 1)->where('show', '=', 1)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'live');
            $ticketsDone = Ticket::where('status', '>', 0)->where('show', '=', 1)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'done');
            $ticketsHidden = Ticket::where('show', '=', 0)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'hidden');
        }

        return view('admin.tickets.index', compact(['ticketsLive', 'ticketsDone', 'ticketsHidden']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->input('package')) {
            $package = $request->get('package');
        } else {
            $package = 1;
        }
        $teams = Team::all();
        return view('admin.tickets.create', compact('teams', 'package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $show = $request->get('show') ?? 0;
        $request->validate([
            'package_id' => 'required',
            'match_id' => 'required',
            'created_at' => 'required',
            'tip' => 'required',
            'cost' => 'required',
        ]);
        try {
            if (isset($request->match_id)) {
                $matchO = Match::findOrFail($request->get('match_id'));
                $match = $matchO->full_name;
                $match_start = $matchO->start;
            }
            $ticket = Ticket::insertGetId([
                'type' => 1,
                'package_id' => $request->get('package_id'),
                'created_at' => Carbon::parse($request->get('created_at')),
                'show' => $show,
                'match_id' => $request->get('match_id'),
                'match_start' => $match_start,
                'tournament_id' => $request->get('tournament'),
                'tip' => $request->get('tip'),
                'odds' => $request->get('odds'),
                'cost' => $request->get('cost'),
            ]);

            Log::info('Pridan tiket s tipem: ' . $ticket, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.tikety.index'))->with('success', 'Tiket přidán!');
        } catch (\Exception $e) {
            return redirect(route('admin.tikety.index'))->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('admin.tickets.show')->with('ticket', $ticket);
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
            $ticket = Ticket::findOrFail($id);
        } catch (\Exception $e) {
            return redirect(route('admin.balicky.index'))->with('error', $e->getMessage());
        }
        return view('admin.tickets.edit')->with('ticket', $ticket);
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
        if ($request->input('action') == 'show') {
            try {
                $ticket = Ticket::findOrFail($id);
                $ticket->show = 1;
                $ticket->save();
                Log::info('Tiket zobrazen: ' . $ticket->id . ' balicek:' . $ticket->package->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                return back()->with('success', 'Tiket zobrazen!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        if ($request->input('action') == 'hide') {
            try {
                $ticket = Ticket::findOrFail($id);
                $ticket->show = 0;
                $ticket->save();
                Log::info('Tiket hide: ' . $ticket->id . ' balicek:' . $ticket->package->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                return back()->with('success', 'Tiket schován!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
        if ($request->input('action') == 'win') {
            try {
                $ticket = Ticket::findOrFail($id);
                $ticket->status = 1;
                $ticket->save();
                $this->checkTicket($ticket);
                return back()->with('success', 'Tip vyhral!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        if ($request->input('action') == 'lose') {
            try {
                $ticket = Ticket::findOrFail($id);
                $ticket->status = 2;
                $ticket->save();
                $this->checkTicket($ticket);
                return back()->with('success', 'Tip prohral!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        if ($request->input('action') == 'revert') {
            try {
                $ticket = Ticket::findOrFail($id);
                $ticket->status = 0;
                $ticket->save();
                $this->checkTicket($ticket);
                return back()->with('success', 'Tip nerozhodnut!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
        if ($request->input('action') == 'storno') {
            try {
                $ticket = Ticket::findOrFail($id);
                $ticket->status = 3;
                $ticket->save();
                $this->checkTicket($ticket);
                return back()->with('success', 'Tip storno !');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        if ($request->input('action') == 'edit') {
            $request->validate([
                'package_id' => 'required',
                'match_id' => 'required',
                'created_at' => 'required',
                'tip' => 'required',
                'cost' => 'required',
            ]);

            try {
                $show = $request->get('show') ?? 0;
                $ticket = Ticket::findOrFail($id);
                $ticket->created_at = Carbon::parse($request->get('created_at'));
                $ticket->package_id = $request->get('package_id');
                $ticket->tip = $request->get('tip');
                $ticket->odds = $request->get('odds');
                $ticket->show = $show;
                $ticket->cost = $request->get('cost');
                $ticket->save();
                Log::info('Tiket upraven: ' . $ticket->id . ' balicek:' . $ticket->package->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                $this->checkTicket($ticket);
                return redirect(route('admin.tikety.index'))->with('success', 'Tiket upraven!');
            } catch (\Exception $e) {
                return redirect(route('admin.tikety.index'))->with('error', $e->getMessage());
            }
        }

        return redirect(route('admin.tikety.index'))->with('error', 'Error: hovno');
    }

    public function sendNotification($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $package = $ticket->package;
            $users = User::whereIn('id', $package->subscriptionsValid->pluck('user_id')->toArray())->orderBy('created_at', 'desc')->get();
            $details = [
                'greeting' => 'Dobrý den,',
                'body' => 'Právě byl na stránkách NHLsazeni.cz vložen nový TIP.',
                'thanks' => 'Toto je automatický e-mail, neodpovídejte!',
                'actionText' => 'Zobrazit',
                'actionURL' => url(route('premium-tipy.show', ['package' => $package->id]))
            ];

            Log::info('Tiket notifikovan: ' . $ticket->id . ' balicek:' . $ticket->package->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            //Notification::send($users->where('notifications', '=', 1), new TicketNotification($details));
            $ticket->notified = 1;
            $ticket->save();
            if ($id != 1 or $id != 5) {
                $package2 = Package::findOrFail(5);
                $users2 = User::whereIn('id', $package2->subscriptionsValid->pluck('user_id')->toArray())->orderBy('created_at', 'desc')->get();
                //Notification::send($users2->where('notifications', '=', 1), new TicketNotification($details));
            }
            return back()->with('success', 'Tiket notifikován!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function sendPremiumTipy()
    {
        try {
            $packages = Package::where('id', '=', 1)->get();
            $details = [
                'body' => 'Právě byl na stránkách NHLsazeni.cz vložen nový TIP.',
                'thanks' => 'Toto je automatický e-mail, neodpovídejte!',
                'actionText' => 'Zobrazit',
                'packages' => $packages,
                'actionURL' => url(route('premium'))
            ];
            Notification::send(Auth::user(), new PackageNotification($details));
            return back()->with('success', 'Tiket notifikován!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function sendMegaTipy()
    {
        try {
            $packages = Package::where('id', '=', 1)->get();
            $details = [
                'body' => 'Právě byl na stránkách NHLsazeni.cz vložen nový TIP.',
                'thanks' => 'Toto je automatický e-mail, neodpovídejte!',
                'actionText' => 'Zobrazit',
                'packages' => $packages,
                'actionURL' => url(route('premium'))
            ];
            Notification::send(Auth::user(), new PackageNotification($details));
            return back()->with('success', 'Tiket notifikován!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function sendPremiumMegaTipy()
    {
        try {
            $packages = Package::where('id', '=', 1)->get();
            $details = [
                'greeting' => 'Dobrý den,',
                'body' => 'Právě byl na stránkách NHLsazeni.cz vložen nový TIP.',
                'thanks' => 'Toto je automatický e-mail, neodpovídejte!',
                'actionText' => 'Zobrazit',
                'packages' => $packages,
                'actionURL' => url(route('premium'))
            ];
            Notification::send(Auth::user(), new PackageNotification($details));
            return back()->with('success', 'Tiket notifikován!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function sendNotifications()
    {
        //TODO Rozdelit uzivatele podle pristupu k balickum
        try {
            $packages = Package::all();
            $details = [
                'body' => 'Právě byl na stránkách NHLsazeni.cz vložen nový TIP.',
                'thanks' => 'Toto je automatický e-mail, neodpovídejte!',
                'actionText' => 'Zobrazit',
                'packages' => $packages,
                'actionURL' => url(route('premium'))
            ];
            Notification::send(Auth::user(), new PackageNotification($details));
            return back()->with('success', 'Tiket notifikován!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
            Ticket::findOrFail($id)->delete();
            Log::info('Tiket smazan: ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
        } catch (\Exception $e) {
            return redirect(route('admin.tikety.index'))->with('error', $e->getMessage());
        }
        return redirect(route('admin.tikety.index'))->with('success', 'Tiket smazán!');
    }
}
