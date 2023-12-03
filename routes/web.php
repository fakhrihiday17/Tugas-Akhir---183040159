<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NovelController;
use App\Models\Novel;

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

Route::get('/', [NovelController::class, 'indexF'])->name('home');
Route::get('/novel', 'NovelController@index')->name('novel.index');

Route::get('/novel/create/', [NovelController::class, 'create'])->name('novel.create');
Route::post('/novel', [NovelController::class, 'store'])->name('novel.store');

Route::get('/novel/chaptercreate/', [NovelController::class, 'chaptercreate'])->name('novel.chaptercreate');
Route::post('/novel/chapterstore', [NovelController::class, 'chapterstore'])->name('novel.chapterstore');

Route::get('/novel/pagecreate', [NovelController::class, 'pagecreate'])->name('novel.pagecreate');
Route::post('/novel/pagestore', [NovelController::class, 'pagestore'])->name('novel.pagestore');

Route::get('/novel/{novelId}', 'NovelController@show')->name('novel.show');

Route::get('/novel/edit/{novelId}', [NovelController::class, 'edit'])->name('novel.edit');
Route::put('/novel/{novelId}', [NovelController::class, 'update'])->name('novel.update');

Route::get('/novel/chapter/{novelId}/edit/{chapterNumber}', [NovelController::class, 'chapterEdit'])
    ->name('novel.chapterEdit');
Route::put('/novel/chapter/{novelId}/{chapterNumber}', [NovelController::class, 'chapterUpdate'])
    ->name('novel.chapterUpdate');

Route::get('/novel/page/edit/{chapterId}/{pageNumber}', [NovelController::class, 'pageEdit'])
    ->name('novel.pageEdit');
Route::put('/novel/page/{chapterId}/{pageNumber}', [NovelController::class, 'pageUpdate'])
    ->name('novel.pageUpdate');

Route::delete('novel/{novelId}', 'NovelController@destroy')->name('novel.destroy');

Route::get('/novel/read/{novelId}/{chapterNumber}/{pageNumber}', [NovelController::class, 'read'])->name('novel.read');

Route::get('/novel/add-to-favorites/{novelId}', 'NovelController@addToFavorites')->name('novel.addToFavorites');
Route::get('/novel/remove-from-favorites/{novelId}', 'NovelController@removeFromFavorites')->name('novel.removeFromFavorites');
Route::get('/favorit', 'NovelController@favorit')->name('novel.favorit');

Route::post('/bookmark', 'NovelController@saveBookmark')->name('novel.saveBookmark');
Route::post('/remove-bookmarks', 'NovelController@remove')->name('novel.remove');

Route::get('/register', 'UserController@register')->name('register');
Route::post('/register', 'UserController@store');
Route::get('/login', 'UserController@showLoginForm')->name('login');
Route::post('/login', 'UserController@login');
Route::post('/logout', 'UserController@logout')->name('logout');

Route::post('/upload-image', [NovelController::class, 'uploadImage']);
