<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;

use App\Models\Diary;
use App\Models\Image;

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

Route::get('/',[DiaryController::class,'index'])->name('home');
Route::get('/create-note',[DiaryController::class,'create_diary'])->name('create.note');

Route::post('/save_note', [DiaryController::class,'store_date'])->name('save.note');
Route::get('/show-details/{id}', [DiaryController::class,'particular_data_all'])->name('show.particular.data');

Route::post('/add-more-data', [DiaryController::class,'add_more_image'])->name('add.more.image');
Route::get('/edit_image/{id}', [DiaryController::class,'edit_image'])->name('edit.image');
Route::put('/update_image/{id}', [DiaryController::class,'update_image'])->name('update.image');
Route::get('/delete_image/{id}', [DiaryController::class,'delete_image'])->name('delete.image');
Route::get('/edit_text/{id}', [DiaryController::class,'edit_text'])->name('edit.text');
Route::put('/update_text/{id}', [DiaryController::class,'update_text'])->name('update.text');
Route::get('/delete-details/{id}', [DiaryController::class,'delete_details'])->name('delete.details');


// Route::get('/check', function () {
//     $diaries = Diary::with('images')->get();
//     return $diaries;
// });
