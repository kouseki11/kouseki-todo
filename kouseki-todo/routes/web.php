<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\DashboardController;
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
Route::middleware('isGuest')->group(function(){
Route::get('/', [TodoController::class, 'index'])->name('login');
Route::post('/login',[TodoController::class, 'auth'])->name('login.auth');
Route::get('/register', [TodoController::class, 'register'])->name('register');
Route::post('/register/store',[TodoController::class, 'registerAccount'])->name('registerAccount');
});

Route::middleware('isLogin')->group(function(){
    Route::get('/home', [TodoController::class, 'home']);
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/create', [TodoController::class, 'create']);
    Route::post('/create/store', [TodoController::class, 'store']);
    Route::get('/completed', [TodoController::class, 'done'])->name('completed');
    Route::get('/update/done/{id}', [TodoController::class, 'updateDone'])->name('updatedone');
    Route::get('/update/undo/{id}', [TodoController::class, 'undo'])->name('updateundo');
    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');
});

Route::post('/logout', [TodoController::class, 'logout']);

