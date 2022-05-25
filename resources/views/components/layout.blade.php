{{-- 共通部分の部品化 --}}
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        {{-- slot以外で値を埋め込む場合別の変数を用意 --}}
        <title> {{ $title }} </title>
        <link rel="stylesheet" href="{{url('css/style.css')}}">
    </head>
    <body>
        <div class="container">
            {{ $slot }}
        </div>

    </body>
</html>

