<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

// return viewまで来ていたら、routingされた後なので直接指定されたページまで飛ぶ。
class SampleController extends Controller
{
    // フォーム初期画面
    public function create(){
            $data = [
                "formkinds" => [
                    ["name" => "書籍の購入","flag" => false],
                    ["name" => "書籍の予約","flag" => false],
                    ["name" => "書籍の情報","flag" => true],
                    ["name" => "当店の希望","flag" => false],
                    ["name" => "その他","flag" => false],
                ],
                "body" => "",
                "name" => "",
                "mail" => "",
                "tel" => "",
            ];

        return view('sample.create',['data' => $data,'re_req' => null]);
    }


    //送信したデータを受け取り、入力内容確認画面に表示する
    public function show(Request $request){
        return view('sample.show',['request'=>$request]);
    }

    // 入力確認画面で再入力を選択したとき、入力画面で入力した情報を
    // 入力画面の各フォームに渡す処理
    public function recreate(Request $request){

        $data = [
            "formkinds" => [
                ["name" => "書籍の購入","flag" => false],
                ["name" => "書籍の予約","flag" => false],
                ["name" => "書籍の情報","flag" => true],
                ["name" => "当店の希望","flag" => false],
                ["name" => "その他","flag" => false],
            ],
            "body" => $request->body,
            "name" => $request->name,
            "mail" => $request->mail,
            "tel" => $request->tel,
        ];
        return view('sample.create',['data' => $data,'re_req'=>$request->formkind]);
    }

    public function send(Request $request){

        // 宛名　タイトル　本文　ヘッダ

        // $to = $request->mail
        // $title = $request->formkind
        // $name = $request->name
        // $body = $request->body

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $to = $request->name;
        $title = $request->formkind;
        $content = $request->body;

        if(mb_send_mail($to, $title, $content)){
          echo "メールを送信しました";
        } else {
          echo "メールの送信に失敗しました";
        };

    }

}

