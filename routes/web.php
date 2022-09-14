<?php



use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


/** 
 * 本の一覧表示
 */

Route::get('/', function () {
    return view('books');
});

/**
 * 本を追加
 */
Route::post('/books', function (Request $request) {
    
    //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
});

/**
 * 本を削除
 */
Route::delete('/book/{book}', function (Book $book) {
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
