<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('unread') == '1') {
            $data = Message::orderBy('read', 'asc')->orderBy('created_at', 'desc');
            $data = $data->where('read', '=', 0)->paginate(10);
        } else {
            $data = Message::orderBy('read', 'asc')->orderBy('read', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('admin.messages.incoming')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Message::findOrFail($id);
        return view('admin.messages.show')->with('contact', $contact);
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
        if ($request->input('action') == 'read') {
            try {
                $contact = Message::findOrFail($id);
                $contact->read = 1;
                $contact->save();

                Log::info('Zprava prectena'. $id, ['id' => Auth::user()->id , 'ip' =>\Request::getClientIp(true)]);
                return back()->with('success', 'Zpráva přečtena!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
        if ($request->input('action') == 'unread') {
            try {
                $contact = Message::findOrFail($id);
                $contact->read = 0;
                $contact->save();
                return back()->with('success', 'Zpráva nepřečtena!');
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

                Log::info('Zprava smazana'. $id, ['id' => Auth::user()->id , 'ip' =>\Request::getClientIp(true)]);
        try {
            Message::findOrFail($id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect(route('admin.zpravy.index'))->with('success', 'Zpráva smazána!');
    }
}
