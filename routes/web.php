<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
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
        Route::group(['prefix' => 'employees'], function () {
            Route::get('/', [EmployeeController::class, 'store']);
            Route::get('/sort', [EmployeeController::class, 'sort']);
            Route::post('/export-csv', [EmployeeController::class, 'export_csv'])->name('export-csv');
            Route::get('/search', [EmployeeController::class, 'search'])->name('search');
            Route::get('/filter', [EmployeeController::class, 'filter'])->name('filter');
            Route::get('/profile/{user}', [EmployeeController::class, 'viewProfile']);
            Route::group(['middleware' => ['verified-admin']], function () {
                Route::get('/import', [EmployeeController::class, 'import'])->name('import');
                Route::post('/import-csv', [EmployeeController::class, 'import_csv'])->name('import-csv');
                Route::delete('/destroy', [EmployeeController::class, 'destroy']);
                Route::get('/edit/{user}', [EmployeeController::class, 'viewEdit']);
                Route::post('/edit/{user}', [EmployeeController::class, 'edit']);
                Route::get('/add', [EmployeeController::class, 'viewAdd'])->name('addUser');
                Route::post('/add/store', [EmployeeController::class, 'add']);
            });
        });
        Route::group(['middleware' => ['verified-admin']], function () {
            Route::group(['prefix' => 'department'], function () {
                Route::get('/', [DepartmentController::class, 'index']);
                Route::get('/add', [DepartmentController::class, 'viewAdd']);
                Route::post('/add/store', [DepartmentController::class, 'store']);
                Route::get('/edit/{department}', [DepartmentController::class, 'show']);
                Route::post('/edit/{department}', [DepartmentController::class, 'edit']);
                Route::delete('/destroy', [DepartmentController::class, 'destroy']);
            });
        });
    });
    Route::group(['middleware' => ['verified-admin']], function () {
        Route::post('/reset/password', [ResetPasswordController::class, 'sendMail'])->name('resetPassword');
    });
});
