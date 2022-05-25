<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SampleController;

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

//     名前のないルーティングにURLを指定しているリンク先がある場合。そのURLを変更すると
//     リンク先もそれに合わせて変更しないといけないので、無駄が生じるのでルーティングに名前をつける
//     そうすることによりリンク先はルーティングの名前に引っ張られるようになるので
//     変更するのはルーティングのURL先だけで良いことになる。

Route::get('/', [PostController::class,'index'])
    ->name('posts.index');

// ルーティングの際URLにパラメタ({変数}のこと)を記述すれば、メソッドなどの引数に渡すことができる
Route::get('/posts/{post}', [PostController::class,'show'])
    ->name('posts.show')
    ->where('post', '[0-9]+');

Route::get('/posts/create', [PostController::class,'create'])
    ->name('posts.create');

Route::post('/posts/store', [PostController::class,'store'])
    ->name('posts.store');

//編集用コントローラーのルーティング
Route::get('/posts/{post}/edit', [PostController::class,'edit'])
    ->name('posts.edit')
    ->where('post', '[0-9]+');

Route::patch('/posts/{post}/update', [PostController::class,'update'])
    ->name('posts.update')
    ->where('post', '[0-9]+');

Route::delete('/posts/{post}/destroy', [PostController::class,'destroy'])
    ->name('posts.destroy')
    ->where('post', '[0-9]+');

Route::post('/posts/{post}/comments', [CommentController::class,'store'])
    ->name('comments.store')
    ->where('post', '[0-9]+');

Route::delete('/comments/{comment}/destroy', [CommentController::class,'destroy'])
    ->name('comments.destroy')
    ->where('comment', '[0-9]+');

Route::get('/sample/create',[SampleController::class,'create'])->name('sample.create');
Route::post('/sample/recreate',[SampleController::class,'recreate'])->name('sample.recreate');
Route::post('/sample/show',[SampleController::class,'show'])->name('sample.show');
Route::post('/sample/send',[SampleController::class,'send'])->name('sample.sendMail');


// URL
// 受け取ったリクエストからどの処理をするかの識別子のようなもの
// 送られてきたurlと一致するurlが紐づくので、同じであるなら何でもいいのかもしれない。getの場合はビューをゲットすることから
// リクエストしたurlがアドレスバーに表示される。postの場合はデータの送信なので、紐づいたurlで処理が終わらないのでurlが表示されない。






// _____________________________________
// 試し場

//やること：お問い合わせのページの作成。　
// ビュー構成：お問い合わせページに入るためのページ、お問い合わせページ、入力内容確認画面、登録確認画面

    // 遷移の流れ各種
        // お問い合わせに入る
        // フォーム入力後送信エラー時に入力画面に戻る
        // フォームの送信成功時に入力内容確認画面に移動
        // 確認オッケーの時、送信完了画面に移動
        // 確認後ノーの時、入力画面に戻る

    // 遷移の際に必要なもの
        // 入力内容確認の際、ノーで入力画面に戻るときに入力したときの値をフォームの各項目に入れておきたいので
        // 入力内容確認時に受診したデータを再度、formにポストの形で渡す(inputのvalueに値を代入するなど)
        // コントローラ側で送信されたものを受け取ったら、配列のキーにそれぞれの値を格納していく
        // ※ビュー側で受け取れるように、配列名を同じにしておくこと

        // フォームエラー時で入力画面に戻った際、値を入力時のままで保持しておきたいので、old関数を使用する。
        // old関数　requestのvalidate時にエラーになった値をname属性の値として格納する

        // さらにold関数では第二引数に変数を代入すると、第一引数の値がない場合にそちらの方を表示してくれる

        // 最初にお問い合わせに入る時、再入力時に入れる変数の中身を持っていないため、エラーになってしまう
        // それを防ぐために、同じ配列のキーに初期値を代入しておく。
        // こうすることにより中身がないえら－を防ぐことができる。

    // わかる部分でコードを記述しておく
//     controller
//         public function index(){
//             // 初期値の配列
//             $data = [
//                 // "formkind" =>
//                 "body" => "",
//                 "name" => "",
//             ]

//             return view('contact.index',['data' => $data]);
//         }


//         public function send(Request $request){
//             // 受診したデータを持って再度入力画面に戻る時の記述
//             $data = [
//                 "body" = $request->body,
//                 "name" = $request->name,
//             ]

//             return view('contact.index',['data' => $data]);
//         }

//     view side

//         <input type="text" name="body" value="{{old('body',$data)}}">
//         <input type="text" name="name" value="{{old('name',$data)}}">




//         radio button

//         @foreach($data['formkinds'] as $formkind)

//         <input type="radio" name="formkind" value="{{$formkind->name}}"
//          {{$fomrkind->flag == true ? checked: "";}}>


//         @endforeach

// old(error時にセッションに保持される値,初期値);
// old('',$formkind->flag)
// old('formkind',$formkind->name) == ""

// if()

// formkind old('',$formkind->flag) == true

// <input type="radio" name="fomrkind" value="" {{old('fomekind',$formkind)}}>
//         中身がある場合において、checkedをほどこす処理をする。


//         inputの中には文字列しか入れることしかできないため、条件に適した真偽値を入れることができない
//         どうすればいいか考える。

//         ケース1　疑問文の条件を変更する。　×

//         <script>
//             let sample = document.querySelectorAll("input[type=radio]").value == "true";
//             // === 等価演算子を使用して、その結果をtrue or falseで表し、変数に中身を格納する。

//             let answer = sample === 'true';
//             if(answer == "true"){

//             }

//             //
//             let sample = document.querySelectorAll("input[type=radio]");

//             sample.forEach(bt =>{
//                 bt.value == "true" ? bt.checked = true : "";
//             });

//             // 問題：送信する値が
//         </script>

