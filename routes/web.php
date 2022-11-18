<?php

use App\Http\Controllers\EmployeeController;
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
    Route::get('/update_profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update_profile/store', [ProfileController::class, 'updateProfileCustom'])->name('updateProfileCustom');
    Route::get('/change_password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::post('/change_password/store', [ProfileController::class, 'changePasswordCustom'])->name('changePasswordCustom');
    Route::post('/upload/store', [UploadController::class, 'store']);
    Route::group(['middleware' => ['verified-account']], function () {
        Route::group(['prefix' => 'list'], function () {
            Route::get('/', [EmployeeController::class, 'store']);
            Route::get('/sort', [EmployeeController::class, 'sort']);
            Route::get('/profile/{user}', [EmployeeController::class, 'viewProfile']);
            Route::get('/search', [EmployeeController::class, 'search'])->name('search');
            Route::get('/filter/room', [EmployeeController::class, 'filterRoom'])->name('filter.room');
            Route::delete('/destroy', [EmployeeController::class, 'destroy']);
            Route::get('/edit/{user}', [EmployeeController::class, 'viewEdit']);
            Route::post('/edit/{user}', [EmployeeController::class, 'edit']);
            Route::get('/add', [EmployeeController::class, 'viewAdd']);
            Route::post('/add/store', [EmployeeController::class, 'add']);
        });
    });
});
