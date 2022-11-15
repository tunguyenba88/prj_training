<?php

use App\Http\Controllers\ListEmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/store', [LoginController::class, 'store']);
Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'store'])->name('profile');
    Route::get('/list', [ListEmployeeController::class, 'store'])->middleware('verified-account');
    Route::post('/update_profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/upload/store', [UploadController::class, 'store']);
    Route::get('/change_password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::post('/change_password/store', [ProfileController::class, 'changePasswordCustom'])->name('changePasswordCustom');
});
