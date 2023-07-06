@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-2">
        {{-- @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
        @endcomponent --}}      
    </div>
</div>

<body>
     <header>
         <nav>
             <div>                
                 <a href="{{ route('posts.index') }}">投稿アプリ</a>          
             </div>
         </nav>
     </header>
 
     <main>
         <article>
             <div>                
                 <h1>新規投稿</h1>   

                 @if($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                 @endif
                 
                 <div>
                     <a href="{{ route('posts.index') }}">&lt; 戻る</a>                                  
                 </div>
 
                 {{-- <form action="{{ route('posts.store')}}" method="post"> --}}
                    {{-- <p>{{$message}}</p> --}}

                    {{ Form::open(['route'=>'posts.store','files'=>true]) }}
                     @csrf
                     <div class="form-group">
                        

                         <label for="title">タイトル</label>


                         <input type="text" name="title" value="{{old('title')}}">
                     </div>
                     <div class='form-group'>
                        {{Form::file('thefile')}}
                        </div>
                     <div>
                         <label for="content">本文</label>
                         <textarea name="content">{{old('content')}}</textarea>
                     </div>
                        <!--ファイルを読み込む-->

                    {{Form::submit('作成する',['class'=>'btn btn-primary'])}}
                        {{-- <button>アップロード</button> --}}
                    {{  Form::close() }}
                 </form>
                </div>
            </article>
        </main>
    
        <footer>        
            <p>&copy; 投稿アプリ All rights reserved.</p>
        </footer>
</body>
    
</html>
@endsection