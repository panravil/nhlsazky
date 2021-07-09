<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TariffRequest;
use App\Package;
use App\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TariffsController extends Controller
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
        $data = Tariff::all();
        return view('admin.tariffs.index')->with('data', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        return view('admin.tariffs.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TariffRequest $request)
    {
        try {
            $tarif = new Tariff([
                'title' => $request->get('title'),
                'seo' => $request->get('seo'),
                'descriptions' => $request->get('desc'),
                'package_id' => $request->get('package_id'),
                'days' => $request->get('days'),
                'to' => $request->get('to'),
                'priceCZK' => $request->get('priceCZK'),
                'priceEUR' => $request->get('priceEUR'),
                'start' => $request->get('start'),
                'end' => $request->get('end'),
                'show' => $request->get('show'),
            ]);
            $tarif->save();

            Log::info('Tarif pridan' . $tarif->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.tarify.index'))->with('success', 'Tarif upraven!');
        } catch (\Exception $e) {
            return redirect(route('admin.tarify.index'))->with('error', $e->getMessage());
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
        $tarif = Tariff::findOrFail($id);
        return view('admin.tariffs.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TariffRequest $request, $id)
    {
        try {
            $tarif = Tariff::findOrFail($id);
            $tarif->title = $request->get('title');
            $tarif->seo = $request->get('seo');
            $tarif->descriptions = $request->get('desc');
            $tarif->package_id = $request->get('package_id');
            $tarif->days = $request->get('days');
            $tarif->to = $request->get('to');
            $tarif->priceCZK = $request->get('priceCZK');
            $tarif->priceEUR = $request->get('priceEUR');
            $tarif->start = $request->get('start');
            $tarif->end = $request->get('end');
            $tarif->show = $request->get('show');
            $tarif->save();

            Log::info('Tarif upraven' . $tarif->title, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
            return redirect(route('admin.tarify.index'))->with('success', 'Tarif upraven!');
        } catch (\Exception $e) {
            return redirect(route('admin.tarify.index'))->with('error', $e->getMessage());
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
        //
    }
}
