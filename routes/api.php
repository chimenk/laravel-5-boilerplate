<?php

use Illuminate\Http\Request;
use App\Testing;
// use Log;
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

Route::post('/py', function(Request $req) {
	$a = new Testing();
	$a->coba = $req->coba;
	if($a->save()){
		\Log::info('ok');
	}else{
		\Log::alert('failed');
	}
});