{{-- 共通部品の読み込み  (他のファイルも同じく)--}}
<x-layout>
    {{-- 細かい部分の埋め込み --}}
    <x-slot name="title">
        MyBBS
    </x-slot>

    <h1>
        <span>MyBBS</span>
        <a href="{{ route('posts.create')}}">[add]</a>
    </h1>
    <ul>
        @forelse($posts as $post)
           <li>
               {{-- route側にパラメタ(渡す値)がある場合は第二引数に値を記述する --}}
               <a href=" {{route('posts.show', $post) }} ">
                {{-- ↑　Routeの第二引数にEloquentのインスタンス(ここでは継承しているPostクラスの変数)
                    が渡された場合、インスタンスの主キーを取得するようになっている --}}
                   {{$post->title}}
               </a>
           </li>
        @empty
            <li>mettyakara</li>
        @endforelse
    </ul>

    <a href="{{route('sample.create')}}">ここ</a>

</x-layout>
