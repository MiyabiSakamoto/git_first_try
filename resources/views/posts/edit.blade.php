<x-layout>
    {{-- ※nameと"="を離して記述するとうまく表示されずエラーになる --}}
    <x-slot name="title">
        Edit Post - MyBBS
    </x-slot>

    {{-- 詳細ページ --}}
    <div class="Back-Link">
        &laquo; <a href="{{route('posts.show',$post)}}">Back</a>
    </div>
    <h1>Edit Post</h1>

    <form method ="post" action="{{route('posts.update',$post)}}" >
        @Method('Patch')
        @csrf

        <div class ="form-group">
            <label>
                title
                {{-- oldは第二引数を指定することができる 第一引数がなければそちらを入力してくれる--}}
                <input type="text" name="title" value="{{old('title',$post->title)}}">
            </label>
            @error('title')
                <div class = "error">{{$message}}</div>
            @enderror
        </div>
        <div class ="form-group">
            <label>
                body
                <textarea name="body">{{old('body',$post->body)}}</textarea>
            </label>
            @error('body')
                <div class = "error">{{$message}}</div>
            @enderror

        </div>

        <div class ="form-button">
            <button>Update</button>
        </div>
    </form>
</x-layout>




