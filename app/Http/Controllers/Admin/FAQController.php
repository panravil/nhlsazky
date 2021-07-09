<?php

namespace App\Http\Controllers\Admin;

use App\FAQ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = FAQ::all();
        return view('admin.faq.index')->with('data', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.faq.create');
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
            'question' => 'required',
            'answer' => 'required',
        ]);
        try {
            $question = new FAQ([
                'question' => $request->get('question'),
                'dsc' => $request->get('dsc'),
                'answer' => $request->get('answer'),
            ]);
            $question->save();

            Log::info('Otazka pridana' . $question->question, ['id' => Auth::user()->id]);
            return redirect(route('admin.faq.index'))->with('success', 'Otázka přidána!');
        } catch (\Exception $e) {
            return redirect(route('admin.faq.index'))->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = FAQ::findOrFail($id);
        return view('admin.faq.edit')->with('template', $template);
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
                'question' => 'required',
                'answer' => 'required',
            ]);
            try {
                $template = FAQ::findOrFail($id);
                $template->question = $request->get('question');
                $template->dsc = $request->get('dsc');
                $template->answer = $request->get('answer');
                $template->save();
                Log::info('Otázka upravena' . $id, ['id' => Auth::user()->id]);
                return redirect(route('admin.faq.index'))->with('success', 'Otázka upravena!');
            } catch (\Exception $e) {
                return redirect(route('admin.faq.index'))->with('error', $e->getMessage());
            }
        }
        if ($request->input('action') == 'show') {
            try {
                $question = FAQ::findOrFail($id);
                $question->show = 1;
                $question->save();

                Log::info('Otazka zobrazena' . $id, ['id' => Auth::user()->id]);
                return back()->with('success', 'Otázka zobrazena!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
        if ($request->input('action') == 'hide') {
            try {
                $question = FAQ::findOrFail($id);
                $question->show = 0;
                $question->save();
                return back()->with('success', 'Otázka schovaná!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
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

        Log::info('Otazka smazana' . $id, ['id' => Auth::user()->id]);
        try {
            FAQ::findOrFail($id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect(route('admin.faq.index'))->with('success', 'Otázka smazána!');
    }
}
