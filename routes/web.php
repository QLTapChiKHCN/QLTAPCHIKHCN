<?php

use App\Http\Controllers\Home\TrangChuController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PhanBien\PhanBienController;
use App\Http\Controllers\Post\PostArticleController;
use App\Http\Controllers\Post\QuanLiBaiVietController;
use App\Http\Controllers\PhanBien\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIGETBAIVIETCotroller;
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
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::get('/post',[PostArticleController::class,'showpost'])->name('ShowPost')->middleware('auth.post');
Route::post('/submit-article', [PostArticleController::class, 'store'])->name('submitArticle');
Route::get('/phanbien',[PhanBienController::class,'show'])->name('PhanBien');
Route::get('/sotapchi/{id}', [TrangChuController::class, 'showBaiVietTheoTapChi'])->name('sotapchi.show');
Route::get('/bai-viet/{id}', [TrangChuController::class, 'showChiTietBaiViet'])->name('bai-viet.show');
Route::get('/check-email', [PostArticleController::class, 'checkEmail'])->name('check-email');

Route::middleware(['auth'])->group(function () {
    Route::get('/quanlibaiviet', [QuanLiBaiVietController::class, 'quanlibaiviet'])->name('quanlibaiviet');
    Route::get('/quanlibaiviet/{id}', [QuanLiBaiVietController::class, 'show'])->name('chitietbaiviet');
    Route::get('/edit-article/{id}', [QuanLiBaiVietController::class, 'edit'])->name('editArticle');
Route::post('/update-article/{id}', [QuanLiBaiVietController::class, 'update'])->name('updateArticle');
Route::post('/articles/{id}/feedback', [QuanLiBaiVietController::class, 'submitFeedback'])->name('submitFeedback');
Route::get('/download-feedback-file/{id}', [QuanLiBaiVietController::class, 'downloadFeedbackFile'])->name('downloadFeedbackFile');
});
Route::get('/download-file/{id}', [QuanLiBaiVietController::class, 'downloadFile'])
    ->name('downloadFile')
    ->middleware('auth');

// phản biện
Route::get('/phanbien',[PhanBienController::class,'index'])->name('PhanBien');
Route::get('/phanbien/To_Do_List',[PhanBienController::class,'To_Do_List'])->name('Working');
Route::get('/phanbien/List_Request',[RequestController::class,'List_Request'])->name('Request');
Route::post('/phanbien/list_Request/{baiviet}',[RequestController::class,'update_stt'])->name('update_bv');

Route::get('/phanbien/To_Do_List/{baiviet}',[PhanBienController::class,'Art_Details'])->name('show');
Route::get('/phanbien/showpdf/{fileName}',[PhanBienController::class,'show_Pdf'])->name('PDF');
Route::get('/phanbien/download/{fileName}',[PhanBienController::class,'download_Pdf'])->name('downloadPDF');
Route::Post('/phanbien/postpdf/{baiviet}',[PhanBienController::class,'post_Pdf'])->name('post_PDF');

