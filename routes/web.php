<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});

Route::get('/b', function () {
    broadcast(new \App\Events\EchoTest(1));
});

Route::get('/c', function () {
    broadcast(new \App\Events\EchoTest(2));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/custom/endpoint/auth', function (\Illuminate\Http\Request $request) {
    $pusher = new Pusher\Pusher(env('PUSHER_APP_KEY'),env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
    return $pusher->socket_auth($request->request->get('channel_name'),$request->request->get('socket_id'));
});

    require __DIR__ . '/auth.php';
