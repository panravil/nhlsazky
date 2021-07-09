<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return response()->json(['name' => 'Behrang No']);
});


Route::get('/calculator', function (Request $request) {

    return response()->json(['season' => 296.86, 'month' =>  91, 'days' => 9.5]);
});
