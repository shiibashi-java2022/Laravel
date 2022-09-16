<?php

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BooksController;

/** 
 * 本ダッシュボード表示
 */
Route::post('/',[BooksController::class,'index']);
/**
 * 本を追加
 */
Route::post('/books',[BooksController::class,'store']);
/**
 * 本を削除
 */
Route::post('/books/{book}',[BooksController::class,'delete']);
/**
 * 更新画面
 */
Route::post('/booksedit/{books}',[BooksController::class,'showUpdate']);
/**
 * 更新処理
 */
Route::post('/books/update',[BooksController::class,'update']);
Auth::routes();

Auth::routes();
Route::get('/home','BooksController@index')->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
