<?php

namespace App\Http\Controllers;

// include composer autoload
// require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class PostController extends Controller
{
    //一覧
    public function index(Post $post) {  
        // $postService = new PostService;
        // $posts = $postService->getPosts();
        // dump($posts);
        // app(\App\Exceptions\Handler::class)->render(request(),throw new \Error('dump report.'));
        // ->render(request(), throw new \Error('dump report.'));
        $posts = Post::all();
        $posts = Post::latest()->get();      
        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request ){ //, PostService $postService
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        // $postService->savePost(
        //     // $request->userId(),
        //     $request->input('title'),
        //     $request->input('content'),
        //     $request->input('images')
        // );

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $filename=$request->file('thefile')->store('public');       //storageフォルダに投稿した画像を保存しファイルパスを格納
                // アスペクト比を維持しつつ画像の幅を1920pxで保存している
        
        // $filename = InterventionImage::make($filename)->resize(300, 200);
        
        //画像の保存
        // Storage::put('public/' . $post->image, $resized);
        $post->image=str_replace('public/','',$filename);        //ファイル名から「public/」を取り除く
        $post->save();

        return redirect()->route('posts.index',['id'=>$post->id])->with('flash_message', '投稿が完了しました');
    }

    public function show(Request $request,$id,Image $image){

        $message='This is your picture.'.$id;
        $post=Post::find($id);

        Storage::disk('local')->exists('public/storage/'.$post->image);
         //$idに格納された番号と一致したデータを引っ張り出す。
        return view('posts.show',['message'=>$message,'post'=>$post]);

        // return view('posts.show', compact('post'));
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post){
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message','投稿を編集しました');
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました');        
    }
}
