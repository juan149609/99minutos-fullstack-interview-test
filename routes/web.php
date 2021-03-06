<?php

use App\Http\Controllers\BranchesControler;
use App\Http\Controllers\CommitsController;
use App\Http\Controllers\PullRequestController;
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

Route::get('/', function () {
    return redirect('/branches');
});

Route::get('/branches', [BranchesControler::class, 'index'])->name('branches')->middleware('validarCredenciales');
Route::get('/branch/{sha}', [BranchesControler::class, 'show'])->name('branch')->middleware('validarCredenciales');
Route::get('/commit/{sha}', [CommitsController::class, 'show'])->name('commit')->middleware('validarCredenciales');
Route::get('/pull-request', [PullRequestController::class, 'index'])->name('pull-request')->middleware('validarCredenciales');
Route::get('/pull-request/{number}', [PullRequestController::class, 'show'])->name('pull-request-info')->middleware('validarCredenciales');
Route::get('/pull-request-close/{number}', [PullRequestController::class, 'closePullReq'])->name('pull-request-close')->middleware('validarCredenciales');
Route::get('/pull-request-create', [PullRequestController::class, 'create'])->name('pull-request-create')->middleware('validarCredenciales');
Route::post('/pull-request', [PullRequestController::class, 'store'])->middleware('validarCredenciales');
Route::get('/error', function () {
    return view('error');
});

Route::get('/error-credenciales', function () {
    return view('error-credenciales');
});
