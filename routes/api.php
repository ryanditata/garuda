<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/announcement-status', function () {
    $setting = \App\Models\AnnouncementSetting::current();
    return response()->json([
        'is_published' => (bool) $setting->is_published,
        'published_at' => $setting->published_at,
        'login_url' => url('/login'),
    ]);
});

