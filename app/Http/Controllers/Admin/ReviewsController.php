<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Review::all();
        return view('admin.texts.indexReviews')->with('data', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Review::all();
        return view('admin.texts.createReviews', compact('data'));
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
            'name' => 'required',
            'reviewdate' => 'required',
            'rating' => 'required',
            'content' => 'required'
        ]);

        Review::create($request->all());

        return redirect()->route('admin.recenze.index')
            ->with('success', 'Recenze pridana');
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
        $template = Review::findOrFail($id);
        $data = Review::all();
        return view('admin.texts.editReviews', compact('data', 'template'));
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
        $review = Review::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'reviewdate' => 'required',
            'rating' => 'required'
        ]);
        $review->update($request->all());
        return redirect()->route('admin.recenze.index')
            ->with('success', 'Recenze upravena');
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
