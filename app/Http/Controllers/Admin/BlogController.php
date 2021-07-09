<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Blog::all();
        return view('admin.texts.indexBlog')->with('data', $data);
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
        $template = Blog::findOrFail($id);
        $data = Blog::all();
        return view('admin.texts.editBlog', compact('data', 'template'));
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
                $template = Blog::findOrFail($id);
                $template->html_template = $request->get('text');
                $template->save();
                Log::info('Blog upravena'. $id, ['id' => Auth::user()->id , 'ip' =>\Request::getClientIp(true)]);
                return redirect(route('admin.blog.index'))->with('success', 'Blog upraven!');
            } catch (\Exception $e) {
                return redirect(route('admin.blog.index'))->with('error', $e->getMessage());
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
