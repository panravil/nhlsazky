<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\SubscriptionNotification;
use App\Package;
use App\Subscription;
use App\Tariff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SubscriptionsControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));
        $package = Package::findOrFail($request->get('package_id'));
        return view("admin.subscriptions.create", compact(['user', 'package']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'user_id' => 'required',
        ]);
        try {
            $user = User::findOrFail($request->get('user_id'));
            if ($user->isSubscribed($request->get('package_id'))) {
                throw new \Exception('Uz ma pritup k tomutu balicku');
            }
            $package = Package::findOrFail($request->get('package_id'));
            if ($request->has('from')) {
                $from = Carbon::parse($request->get('from'));
                if ($request->has('to')) {
                    $to = Carbon::parse($request->get('to'));
                }
            } else {
                $from = Carbon::now();

                if ($request->has('to')) {
                    $to = Carbon::parse($request->get('to'));
                }
            }
            $price = 0;
            if ($request->has('tarif_id')) {
                $tarif = Tariff::findOrFail($request->has('tarif_id'));
                if ($tarif->days > 0) {
                    $to = $from->copy()->addDays($tarif->days);
                } else {
                    $to = $tarif->to;
                }
                $price = $tarif->priceCZK;
                $from->startOfDay();
                $to->startOfDay();
            }

            if ($request->has('price'))
                $price = $request->get('price');
            if ($to < $from) {
                throw new \Exception('Od > Do');
            }
            $user->subscribePackage($request->get('package_id'), $from, $to, $price, $request->get('tarif_id'));

            return redirect(route('admin.uzivatele.show', $request->get('user_id')))->with('success', 'Předplatné přidáno!');
        } catch (\Exception $e) {
            return redirect(route('admin.uzivatele.show', $request->get('user_id')))->with('error', $e->getMessage());
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
        $sub = Subscription::findOrFail($id);
        return view("admin.subscriptions.edit", compact(['sub']));
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
        if ($request->input('action') == 'edit') {
            $request->validate([
                'package_id' => 'required',
                'user_id' => 'required',
                'from' => 'required',
                'to' => 'required'
            ]);

            try {
                $sub = Subscription::findOrFail($id);
                $sub->to = Carbon::parse($request->get('to'));
                if ($request->has('price')) {
                    $sub->priceCZK = $request->get('price');
                }
                $sub->save();

                Log::info('Predplatne upravene uzivatel:' . $sub->user->email . ' balicek:' . $sub->package->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                return redirect(route('admin.uzivatele.show', $request->get('user_id')))->with('success', 'Předplatné upraveno!');
            } catch (\Exception $e) {
                return redirect(route('admin.uzivatele.show', $request->get('user_id')))->with('error', $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $sub = Subscription::findOrFail($id);
            $sub->to = Carbon::now()->subDay();
            $sub->save();

            Log::info('Predplatne zruseno: ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.uzivatele.show', $request->get('user_id')))->with('success', 'Předplatné zrušeno!');
        } catch (\Exception $e) {
            return redirect(route('admin.uzivatele.show', $request->get('user_id')))->with('error', $e->getMessage());
        }
    }
}
