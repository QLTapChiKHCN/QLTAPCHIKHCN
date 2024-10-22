<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIGETBAIVIETCotroller;

Route::get('/get-files', [APIGETBAIVIETCotroller::class, 'getFiles']); // Lấy danh sách file
Route::get('/download-file/{id}', [APIGETBAIVIETCotroller::class, 'downloadFile']); // Tải file

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
