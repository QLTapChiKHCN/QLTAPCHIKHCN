<?php

use App\Http\Controllers\Home\TrangChuController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PhanBien\PhanBienController;
use App\Http\Controllers\Post\PostArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[TrangChuController::class,'index'])->name('Trangchu');
Route::get('/login',[AuthController::class,'Showlogin'])->name('Login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register',[AuthController::class,'Showregister'])->name('Register');
Route::get('/post',[PostArticleController::class,'showpost'])->name('ShowPost')->middleware('auth.post');
Route::post('/submit-article', [PostArticleController::class, 'store'])->name('submitArticle');
Route::get('/phanbien',[PhanBienController::class,'show'])->name('PhanBien');
Route::get('/sotapchi/{id}', [TrangChuController::class, 'showBaiVietTheoTapChi'])->name('sotapchi.show');
Route::get('/bai-viet/{id}', [TrangChuController::class, 'showChiTietBaiViet'])->name('bai-viet.show');
Route::get('/check-email', [PostArticleController::class, 'checkEmail'])->name('check-email');
