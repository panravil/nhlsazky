<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Redirect;

class RedirectsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Redirect::all();
        return view('admin.redirects.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $redirect = Redirect::findOrFail($id);
        return view('admin.redirects.show')->with('redirect', $redirect);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.redirects.create');
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
            'title' => 'required',
            'seo' => 'required',
            'url' => 'required',
        ]);
        try {
            $redirect = new Redirect([
                'title' => $request->get('title'),
                'seo' => $request->get('seo'),
                'desc' => $request->get('desc'),
                'img' => $request->get('img'),
                'url' => $request->get('url'),
            ]);
            $redirect->save();
            Log::info('Redirect pridan' . $redirect->title, ['id' => Auth::user()->id]);
            return redirect(route('admin.redirects.index'))->with('success', 'Banner přidán!');
        } catch (\Exception $e) {
            return redirect(route('admin.redirects.index'))->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $template = Redirect::findOrFail($id);
        return view('admin.redirects.edit')->with('template', $template);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'seo' => 'required',
            'url' => 'required',
        ]);
        try {
            $template = Redirect::findOrFail($id);
            $template->title = $request->get('title');
            $template->seo = $request->get('seo');
            $template->desc = $request->get('desc');
            $template->url = $request->get('url');
            $template->img = $request->get('img');
            $template->save();

            Log::info('Upraven redirect: ' . $id, ['user' => Auth::user()->id]);
            return redirect(route('admin.redirects.index'))->with('success', 'Redirect upravena!');
        } catch
        (Exception $e) {
            Log::error('Upraven banner: ' . $id, ['user' => Auth::user()->id, 'errorMsg' => $e->getMessage()]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Redirect::findOrFail($id)->delete();
            Log::info('Redirect smazan ' . $id, ['id' => Auth::user()->id]);
        } catch (\Exception $e) {
            return redirect(route('admin.redirects.index'))->with('error', $e->getMessage());
        }
        return redirect(route('admin.redirects.index'))->with('success', 'Redirect smazán!');
    }
}
