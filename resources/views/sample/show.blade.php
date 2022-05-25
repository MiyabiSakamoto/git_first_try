{{-- 共通部品の読み込み  (他のファイルも同じく)--}}
<x-layout>
    {{-- 細かい部分の埋め込み --}}
    <x-slot name="title">
        MyBBS
    </x-slot>

    <div class="container">
        {{$request->formkind;}}

        <form method ="post" action="{{route('sample.sendMail')}}">
            @csrf

            <input type="hidden" name="name" value="{{$request->name}}">
            <input type="hidden" name="formkind" value="{{$request->formkind}}">
            <input type="hidden" name="body" value="{{$request->body}}">

            <input type="submit" value="はい">
        </form>

        <form method="post" action="{{route('sample.recreate')}}">
            @csrf
            <input type="hidden" name="formkind" value="{{$request->formkind}}">
            <input type="submit" value="いいえ">
        </form>
        <form method="get" action="#">
            <input type="submit" value="戻る">
        </form>

    </div>

</x-layout>
