<?php

use Illuminate\Support\Facades\Route;
use App\Models\job_list;
use App\Http\Controllers\JobListController;

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

Route::get('/', [JobListController::class, 'index'])->name('index');

Route::post('/', [JobListController::class, 'store'])->name('store');

Route::delete('/{job_list:id}', [JobListController::class, 'destroy'])->name('destroy');

Route::get('/done/{job_list:id}', [JobListController::class, 'done'])->name('done');

Route::get('/job/{id}/edit', [JobListController::class, 'edit'])->name('edit');

Route::patch('/job/{id}', [JobListController::class, 'update'])->name('update');;
