<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Event::all();
        return view('admin.texts.indexEvents')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.sections.show');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Event::all();
        return view('admin.texts.createEvent', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Event::findOrFail($id);
        $data = Event::all();
        return view('admin.texts.editEvent', compact('data', 'template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $request->validate([
                'title' => 'required',
                'seo' => 'required',
                'text' => 'required',
            ]);
            try {
                $template = Event::findOrFail($id);
                $template->title = $request->get('title');
                $template->seo = $request->get('seo');
                $template->from = $request->get('from');
                $template->to = $request->get('to');
                $template->bigbanner = $request->get('bigbanner', false);
                $template->show = $request->get('show', false);
                $template->show_menu = $request->get('show_menu', false);
                $template->note = $request->get('note');
                $template->tariff_id = $request->get('tariff_id');
                $template->html_template = $request->get('text');
                $template->save();
                Log::info('Udalost upravena'. $id, ['id' => Auth::user()->id , 'ip' =>\Request::getClientIp(true)]);
                return redirect(route('admin.udalosti.index'))->with('success', 'Udalost upraven!');
            } catch (\Exception $e) {
                return redirect(route('admin.udalosti.index'))->with('error', $e->getMessage());
            }
    }

        public function store(Request $request)
    {
            $request->validate([
                'title' => 'required',
                'seo' => 'required',
                'text' => 'required',
            ]);
            try {
                $template = new Event();
                $template->title = $request->get('title');
                $template->seo = $request->get('seo');
                $template->from = $request->get('from');
                $template->to = $request->get('to');
                $template->bigbanner = $request->get('bigbanner');
                $template->show = $request->get('show');
                $template->tariff_id = $request->get('tariff_id');
                $template->show_menu = $request->get('show_menu');
                $template->note = $request->get('note');
                $template->html_template = $request->get('text');
                $template->save();
                Log::info('Udalost upravena'. $request->get('title'), ['id' => Auth::user()->id , 'ip' =>\Request::getClientIp(true)]);
                return redirect(route('admin.udalosti.index'))->with('success', 'Udalost pridana!');
            } catch (\Exception $e) {
                return redirect(route('admin.udalosti.index'))->with('error', $e->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
