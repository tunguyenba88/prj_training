<?php

use App\Http\Controllers\ListEmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
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
    // Route::get('/profile_user', [ProfileController::class, 'view_profile'])->name('view');
    // Route::post('/update_profile', [ProfileController::class, 'update_view'])->name('update_view');
    Route::post('/update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');
});
