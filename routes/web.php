<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;

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

// route d'authentification pour les trois
Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// pour les utilisateurs
Route::group(['middleware' => ['auth', 'role:user' ]], function () {
    Route::get('/dashboard/myprofile', [UserController::class, 'myprofile'])->name('dashboard.myprofile');
});

// pour les admin
Route::group(['middleware' => ['auth', 'role:admin' ]], function () {
    Route::get('/dashboard/joblist', [AdminController::class, 'joblist'])->name('dashboard.joblist');
});

// pour les Superadmin
Route::group(['middleware' => ['auth', 'role:superadmin' ]], function () {
    Route::get('/dashboard/userlist', [SuperAdminController::class, 'userlist'])->name('dashboard.userlist');
    Route::get('/dashboard/joblist', [AdminController::class, 'joblist'])->name('dashboard.joblist');

    Route::get('/usercreate', [SuperAdminController::class, 'usercreate'])->name('create');
    Route::put('/usersave', [SuperAdminController::class, 'usersave'])->name('save');;

    Route::get('/dashboard/userlist/usershow/{user}', [SuperAdminController::class, 'usershow']);

    Route::get('/dashboard/userlist/useredit/{user}', [SuperAdminController::class, 'useredit']);
    Route::put('/update', [SuperAdminController::class, 'userupdate'])->name('update');

    Route::delete('/dashboard/userlist/{user}', [SuperAdminController::class, 'delete'])->name('delete');



});

require __DIR__.'/auth.php';
