<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Section::all();
        return view('admin.texts.indexSections')->with('data', $data);
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
    public function edit($id)
    {
        $template = Section::findOrFail($id);
        $data = Section::all();
        return view('admin.texts.editSection', compact('data', 'template'));
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
                'text' => 'required',
            ]);
            try {
                $template = Section::findOrFail($id);
                $template->html_template = $request->get('text');
                $template->save();
                Log::info('Sekce upravena'. $id, ['id' => Auth::user()->id , 'ip' =>\Request::getClientIp(true)]);
                return redirect(route('admin.texty.index'))->with('success', 'Text upraven!');
            } catch (\Exception $e) {
                return redirect(route('admin.texty.index'))->with('error', $e->getMessage());
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
