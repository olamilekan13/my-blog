<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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


Route::get('/',[PostController::class,'index']);
Route::get('admin/post/add',[PostController::class,'add']);
Route::get('admin/post/edit/{id}',[PostController::class,'edit']);
Route::get('admin/post/update/{id}',[PostController::class,'update']);
Route::post('admin/post/store', [PostController::class, 'store']);
Route::get('admin/posts', [PostController::class, 'adminIndex']);


