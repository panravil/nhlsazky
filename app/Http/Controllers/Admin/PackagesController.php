<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use App\Ticket;
use Illuminate\Http\Request;

class PackagesController extends Controller
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
        $data = Package::all();
        return view('admin.package.index')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::findOrFail($id);
        $tickets = Ticket::where('package_id', '=', $package->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.package.show', compact(['package', 'tickets']));
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
            $data = Package::findOrFail($id);
        } catch (\Exception $e) {
            return redirect(route('admin.balicky.index'))->with('error', $e->getMessage());
        }
        return view('admin.package.edit')->with('data', $data);
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
            $request->validate([
                'title' => 'required',
            ]);

            try {
                $package = Package::findOrFail($id);
                $show = $request->get('show') ?? 0;
                $package->title = $request->get('title');
                $package->desc = $request->get('desc');
                //$package->color = $request->get('color');
                $package->save();

                Log::info('Balicek upraven' . $id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                return redirect(route('admin.balicky.index'))->with('success', 'Balíček upraven!');
            } catch (\Exception $e) {
                return redirect(route('admin.balicky.index'))->with('error', $e->getMessage());
            }
    }
}
