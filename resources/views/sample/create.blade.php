{{-- 共通部品の読み込み  (他のファイルも同じく)--}}
<x-layout>
    {{-- 細かい部分の埋め込み --}}
    <x-slot name="title">
        MyBBS
    </x-slot>

    <div class="container">
        <h2>お問い合わせ</h2>
        <form method="post" action="{{route('sample.show')}}" id="contact_form">
            @csrf
            {{-- お試し --}}



                <label>お問い合わせ項目
                  <ul>
                    @foreach($data['formkinds'] as $formkind)
                    {{-- 再入力後の入力画面にチェックを保持するためのif。 値がなければ(nullであれば)ここを飛ばす
                        初めて入力画面にきた際にはチェックをデフォルトにしておくためにcontroller側では
                        nullを入れて置きこの処理飛ばすようにしている --}}
                        @if(isset( $re_req ))
                        {{-- {{$formkind['name'] == $re_req ? $formkind['flag'] = true: $formkind['flag'] = false;}} --}}
                        <?php $formkind['name'] == $re_req ? $formkind['flag'] = true: $formkind['flag'] = false;?>
                        @endif
                        <?php  $answer = $formkind['flag'] == true ? $formkind['name'] : ""; ?>
                        <span>{{$formkind['name'];}}</span>
                        <li><input type="radio" name="formkind" value="{{$formkind['name']}}" {{old('formkind',$answer) == $formkind['name'] ? "checked" : ""}}></li>
                        @endforeach
                    </ul>
                </label>

                <div class ="form-group">
                    <label>問い合わせ内容<textarea name="body">{{old('body')}}</textarea></label>
                    @error('body') <div class = "error">{{$message}}</div> @enderror
                </div>
                <div class ="form-group">
                    <label>お名前<input type="text" name="name" value="{{old('name')}}"></label>
                    @error('name') <div class = "error">{{$message}}</div>  @enderror
                </div>
                <div class ="form-group">
                    <label>メールアドレス<input type="text" name="mail" value="{{old('mail')}}"></label>
                    @error('email') <div class = "error">{{$message}}</div>  @enderror
                </div>
                {{-- <div class ="form-group">
                    <label>お名前<input type="text" name="name" value="{{old('name')}}"></label>
                    @error('title') <div class = "error">{{$message}}</div>  @enderror
                </div>
                <div class ="form-group">
                    <label>お名前<input type="text" name="name" value="{{old('name')}}"></label>
                    @error('title') <div class = "error">{{$message}}</div>  @enderror
                </div> --}}

            {{-- @error('body')
                <div>{{$message}}</div>
            @enderror --}}

            {{-- error文すべて --}}
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach

            <input type="submit">

        </form>
    </div>

</x-layout>
