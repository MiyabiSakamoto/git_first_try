<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // private $posts =
    //     [
    //         'title1',
    //         'title2',
    //         'title3',
    //     ];


    public function index() {
        // データベースのレコードをすべて取得
        // $posts = Post::all();

        // レコードを作成日時の遅い順に並べる
        // $posts = Post::orderBy('created_at','desc')->get();
        $posts = Post::latest()->get();


        return view('index')
            ->with(['posts'=>$posts]);
    }
    // 仮引数にmodelクラスの型を宣言しビューと同じ変数に設定すれば、送信元の数値に対応したレコードを取得できる
    // (これをimplicit bindingという)
    public function show(Post $post) {
    // findOrFailは該当しないパラメタが送られたときにnot foundとページを表示する仕組みになっている
        // $posts = Post::findOrFail($id);
    //行先のファイルのパスが階層構造になったら"/"を"."に変えて記述する(下記に記述している)
        return view('posts.show')
            ->with(['post'=>$post]);
    }

    public function create(){
        return view('posts.create');
    }

    // storeに値がわたる前にPostRequestでデータのチェックを行ってくれる
    public function store(PostRequest $request){

        $post = new Post();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect()
            ->route('posts.index');
    }

    // 編集用ルーティングの処理、ビューへの導き　(implicit binding使用)
    public function edit(Post $post) {

            return view('posts.edit')
                ->with(['post'=>$post]);
        }



    //リストの中身の更新処理
    public function update(PostRequest $request,Post $post){

            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            return redirect()
            // ルーティングのURLの中にparameterがあるのでパラメタに渡す値を第二引数に記述
                ->route('posts.show',$post);
        }

    // リストアイテムの削除
    public function destroy(Post $post){

        $post->delete();

        return redirect()
            ->route('posts.index');
        }

}

//  二つは記述方法が違うだけで同じ処理をする
//　foreach(引数=>{処理};)　　　　　(function (引数){処理})
//  foreach(配列 as 変数){method(引数(foreachの変数)){処理;}}

// function (引数){処理} === (引数)=>{処理}
// 引数が一つの場合　function(引数){処理} === 引数 =>{処理} ※引数がない場合は"()=>{処理}"とすること
// 処理が一文である場合"{}を消しても良い　　(引数)　=> 処理;
// 引数が一つで処理も一つの場合?  引数　=> 処理;



// old関数　requestのvalidate時にエラーになった値をname属性の値として格納する

// requestで送ったname属性の値をvalidate時のエラーの時にsession側のinput_requestという項目に
// 保存されるので、old関数はその値を取得する関数
// ※oldの引数はname属性にしておかないと、取得できないことが判明(実験済み)
// @error()の引数もname属性を指定すること(こっちはなんでかわからない) エラー文は$messageを@errro～@enderrorの中に記述すること


//redirect,viewの使い分け　
//getではviewを使い、redirectはpost先の処理内でそれぞれ活用する

// getで送ることができるのはリクエストはクエリパラメタのみで
// ルートパラメタがルーティング時に設定されている場合はviewもしくはredirect時に第二引数として
// 値を持っていく。※第二引数にmodelのインスタンスを渡す場合、ルーティング側のパラメタが同じ変数名なら、モデルのidがわたるようになっている
// さらにパラメタを渡すルーティング先の仮引数にmodelクラスの型を宣言しビューと同じ変数に設定すれば、
// 送信元の数値に対応したレコードを取得できる (これをimplicit bindingという)

// get・postなどのリクエストはuse Requestを使っていれば
// 送信したデータでもクエリパラメタでも取得することが可能になっている。

// ブラウザでurlを入力すると、httpリクエストはgetメソッドになっています
// queryパラメータを取得するには、コントローラ先でuse Requestを使っていれば
// $request->input(queryパラメタのキー)の形で取得可能

// ルートパラメタはhttpのリクエストの種類に関係なく設定することができる
// 識別するための変数と考えるといい。


// 2022年5月20日
// laravel

// <input type="radio" name="formkind" value="{{}}">

//  お問い合わせフォームに渡す初期値　controller側

// public function index(){

//     $data = [
//         "formkinds" => [
//             ["0" => "書籍の購入","flag" => true],
//             ["1" => "書籍の購入","flag" => false],
//             ["2" => "書籍の購入","flag" => false],
//             ["3" => "書籍の購入","flag" => false],
//             ["4" => "書籍の購入","flag" => false],
//         ],
//         "body" => "",
//         "name" => "",
//         "mail" => "",
//         "kana" => "",
//     ]
//         return view(filepass,['data' => $data]);
// }


// 文字列にすることにより、送信先のinputタグのcheckedの条件に
// 値を入れる必要

// <input type="text" name="kkk" value="$formkind->name,$formkind->flag"
//     {{}}>

//     <input= type="radio">

//     <input type="radio" name ="aaa" value>
//     <input type="radio">
//     <input type="radio">
//     <input type="radio">
//     <input type="radio">
