<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
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
        $users = User::orderBy('id');
        if ($request->input() != null) {
            if ($request->input('package') != null) {
                if ($request->input('package') == '0') {
                    $subs = Subscription::where('to', '>=', date('Y-m-d'));
                    $users = User::whereNotIn('id', $subs->pluck('user_id')->toArray())->orderBy('created_at', 'desc');
                } else {

                    $package = Package::findOrFail($request->input('package'));
                    $users = User::whereIn('id', $package->subscriptionsValid->pluck('user_id')->toArray())->orderBy('created_at', 'desc');
                }
            }
            if ($request->input('deleted') == '1') {
                $users = User::onlyTrashed();
            }
            if ($request->input('notification') == '1') {
                $users = $users->where('notifications', '=', 1);
            }
            if ($request->input('search') != null) {
                if (isset($package)) {
                    $users = User::where([['name', 'LIKE', '%' . $request->input('search') . '%'], ['id', 'IN', $package->subscriptionsValid->pluck('user_id')->toArray()]])
                        ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                } else {
                    $users = User::where('name', 'LIKE', '%' . $request->input('search') . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                }
            }
        }
        return view('admin.users.index')->with('data', $users->paginate(30));
    }


    public function export(Request $request)
    {
        $users = User::orderBy('id');
        if ($request->input() != null) {
            if ($request->input('package') != null) {
                if ($request->input('package') == '0') {
                    $subs = Subscription::where('to', '>=', date('Y-m-d'));
                    $users = User::whereNotIn('id', $subs->pluck('user_id')->toArray())->orderBy('created_at', 'desc');
                } else {
                    $package = Package::findOrFail($request->input('package'));
                    $users = User::whereIn('id', $package->subscriptionsValid->pluck('user_id')->toArray())->orderBy('created_at', 'desc');
                }
            }
            if ($request->input('deleted') == '1') {
                $users = User::onlyTrashed();
            }
            if ($request->input('notification') == '1') {
                $users = $users->where('notifications', '=', 1);
            }
            if ($request->input('search') != null) {
                if (isset($package)) {
                    $users = User::where([['name', 'LIKE', '%' . $request->input('search') . '%'], ['id', 'IN', $package->subscriptionsValid->pluck('user_id')->toArray()]])
                        ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                } else {
                    $users = User::where('name', 'LIKE', '%' . $request->input('search') . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                }
            }
        }
        foreach ($users->pluck('email')->toArray() as $email) {
            echo $email . ', ';
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
        $data = User::findOrFail($id);
        return view('admin.users.show')->with('data', $data);
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
            $data = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect(route('admin.users.index'))->with('error', $e->getMessage());
        }
        return view('admin.users.edit')->with('data', $data);
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
        if ($request->input('action') == 'restore') {
            try {
                User::withTrashed()->find($id)->restore();
                Log::info('Uzivatel obnoven ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                return redirect(route('admin.uzivatele.index'))->with('success', 'Uživatel obnoven!');
            } catch (\Exception $e) {
                return redirect(route('admin.uzivatele.index'))->with('error', $e->getMessage());
            }
        }
        if ($request->input('action') == 'edit') {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);

            try {
                $newsletter = $request->get('newsletter') ?? 0;
                $notifications = $request->get('notifications') ?? 0;
                $user = User::findOrFail($id);
                if (Auth::user()->id == $id and $user->admin == true) {
                    return redirect(route('admin.uzivatele.index'))->with('error', 'Admin: nejde upravit');
                }
                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->jmeno = $request->get('jmeno');
                $user->prijmeni = $request->get('prijmeni');
                $user->telefon = $request->get('telefon');
                $user->newsletter = $newsletter;
                $user->notifications = $notifications;
                $user->save();

                Log::info('Uzivatel upraven ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                return redirect(route('admin.uzivatele.show', $user->id))->with('success', 'Uživatel upraven!');
            } catch (\Exception $e) {
                return redirect(route('admin.uzivatele.show', $user->id))->with('error', $e->getMessage());
            }
        }

        return redirect(route('admin.uzivatele.index'))->with('error', 'Error: hovno');
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
            User::findOrFail($id)->delete();
            Log::info('Uzivatel smazan ' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
        } catch (\Exception $e) {
            return redirect(route('admin.uzivatele.index'))->with('error', $e->getMessage());
        }
        return redirect(route('admin.uzivatele.index'))->with('success', 'Uživatel smazán!');
    }
}
