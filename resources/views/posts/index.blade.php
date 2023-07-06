@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-2">
        {{-- @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
        @endcomponent --}}      
    </div>
</div>
<!--======== 前略 ========-->
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
                <h1>投稿一覧</h1>     
                @if(session('flash_message'))
                    <p>{{ session('flash_message')}}</p>     
                @endif
                
                <div>
                    <a href="{{ route('posts.create')}}">新規投稿</a>
                </div>
                    @foreach($posts as $post)
                        <div>
                            <div>
                                <h2>{{ $post->title }}</h2>
                                <p><img src="{{ asset('/storage/'.$post->image)}}" width="200" height="auto"></p>
                                <p>{{ $post->content }}</p>

                                {{-- @props([
                                    'images' => []
                                ])
                                @if(count($images) > 0 )
                                    <div>   
                                        @foreach($images as $image)
                                            <p><img alt="{{$image->name }}"  src="{{asset('storage/images' . $image->name)}}" . width="25%"></p>
                                        @endforeach
                                    </div>
                                @endif --}}
                                <div>
                                    <a href="{{ route('posts.show', $post)}}">詳細</a>
                                    <a href="{{ route('posts.edit', $post)}}">編集</a>

                                    <form action="{{ route('posts.destroy', $post)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">削除</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    @endforeach
            </div>
        </article>
    </main>

    <footer>        
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>
</body>

</html>
@endsection
