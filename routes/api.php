<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIGETBAIVIETCotroller;
use App\Http\Controllers\APIGETHINHANH;

Route::get('/get-files', [APIGETBAIVIETCotroller::class, 'getFiles']); // Lấy danh sách file
Route::get('/download-file/{id}', [APIGETBAIVIETCotroller::class, 'downloadFile']); // Tải file
Route::get('/download-feedback/{maBaiBao}/{maNguoiDung}/{ngayGui}', [APIGETBAIVIETCotroller::class, 'downloadFilePhanHoi'])
    ->name('downloadFeedback');
    Route::post('/upload-image', [APIGETHINHANH::class, 'upload']);
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
