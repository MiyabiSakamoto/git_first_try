<x-layout>
    {{-- ※nameと"="を離して記述するとうまく表示されずエラーになる --}}
    <x-slot name="title">
        {{ $post->title }} - MyBBS
    </x-slot>

    {{-- 一つ前に戻るリンク --}}
    <div class="Back-Link">
        &laquo; <a href="{{route('posts.index')}}">Back</a>
    </div>

    {{-- 詳細アイテムの編集リンク --}}
    <h1>
        <span>{{$post->title}}</span>
        <a href="{{route('posts.edit',$post)}}">[edit]</a>
        <form method ="post" action="{{route('posts.destroy',$post)}}" id ="delete_post">
            @Method('Delete')
            @csrf
            <button class="btn">[×]</button>
        </form>
    </h1>

    {{-- 入力値をエスケープ処理。その後改行をタグを改行文字の前に挿入。※一番外のエスケープ処理は外している
        あるタグによる操作だけしたいときの記述法--}}
    <p>{!! nl2br(e($post->body)) !!}</p>

    <h2>comments</h2>

    <ul>
        <li>
            <form method ="post" action="{{route('comments.store',$post) }}" class = "comment_form">
                @csrf

                <input type="text" name ="body">
                <button>add</button>
            </form>
        </li>
            {{-- latestにすることで最新順にコメントが並ぶようにする --}}
        @foreach($post->comments()->latest()->get() as $comment)
            <li>
                {{$comment->body}}
                <form method ="post" action="{{route('comments.destroy',$comment)}}" class="delete-comment">
                    @method('DELETE')
                    @csrf

                    <button class="btn">[×]</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
        {

        document.getElementById('delete_post').addEventListener('submit', e =>{
            e.preventDefault();

            if(!confirm('本当に削除しますか?')){
                return;
            }
            e.target.submit();
        });

        document.querySelectorAll('.delete-comment').forEach(form =>{
            form.addEventListener('submit', e =>{
                e.preventDefault();

                if(!confirm('削除しますか？')){
                    return;
                }
                form.submit();
            });
        });

    }
        // addEventListener('submit',e =>{
        //     e.preventDefault();

        //     if(!confirm('削除しますか？')){
        //         return;
        //     }

        // })
    </script>
</x-layout>


