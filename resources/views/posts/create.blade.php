<x-layout>
    {{-- ※nameと"="を離して記述するとうまく表示されずエラーになる --}}
    <x-slot name="title">
        Add New Post - MyBBS
    </x-slot>

    <div class="Back-Link">
        &laquo; <a href="{{route('posts.index')}}">Back</a>
    </div>
    <h1>Add New Post</h1>

    <form method ="post" action="{{route('posts.store')}}" >
        @csrf

        <div class ="form-group">
            <label>
                title
                <input type="text" name="title" value="{{old('title')}}">
            </label>

            @error('title')
                <div class = "error">{{$message}}</div>
            @enderror
        </div>
        <div class ="form-group">
            <label>
                body
                <textarea name="body">{{old('body')}}</textarea>
            </label>
            @error('body')
                <div class = "error">{{$message}}</div>
            @enderror

        </div>

        <div class ="form-button">
            <button>add</button>
        </div>
    </form>
</x-layout>
