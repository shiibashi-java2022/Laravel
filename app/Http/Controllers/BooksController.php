<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller{

    //コンストラクタ
    public function __construct(){
        $this -> middleware('auth');
    }
    /** 
    * 本ダッシュボード表示
    */
    public function index() {
        $books = Book::where('user_id',Auth::user()->id)
        -> orderBy('create_at','asc')
        -> paginate(3);
        return view('books', [
            'books' => $books
        ]);
        //return view('books',compact('books')); //も同じ意味
    }

    public function update(Request $request){
         //バリデーション
         $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
    ]);
    //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
    }
    
    //データ更新
    $books = Book::find($request->id);
    $books->item_name   = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published   = $request->published;
    $books->save();
    return redirect('/');
    }

    //登録
    public function store(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|max:255|min:3',
            'item_number' => 'required|max:3|min:1',
            'item_amount' => 'required|max:6',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $file = $request->file('item_img');
        if(!empty($file)){
            $filename = $file->getClientOriginalName();//ファイル名を取得
            $file->move('./upload/',$filename);//ファイルを移動
        }else{
            $filename = "";
        }
        
        // Eloquentモデル（登録処理）
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number =$request->item_number;
        $books->item_amount =$request->item_amount;
        $books->item_img = $filename;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/') -> with('message','本登録が完了しました');
    }

    /**
     * 本を削除
    */
    public function delete(Book $book) {
        $book->delete();       //追加
        return redirect('/');  //追加
    }

    //更新画面
    public function edit($book_id) {
     $books = Book::where('user_id',Auth::user()->id)->find($book_id);
     return view('booksedit', ['book' => $books]);
    }


    
}