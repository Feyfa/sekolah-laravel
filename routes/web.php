<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/insert', [DashboardController::class, 'insert'])->middleware('auth');
Route::post('/insert', [DashboardController::class, 'store']);
Route::post('/user/update', [DashboardController::class, 'update_user']);

Route::get('/list', [DashboardController::class, 'list'])->middleware('auth');
Route::get('/list/edit/{murid:nis}', [DashboardController::class, 'edit'])->middleware('auth');
Route::get('/list/search', [DashboardController::class, 'search']);
Route::put('/list', [DashboardController::class, 'update']);
Route::delete('/list', [DashboardController::class, 'delete']);


