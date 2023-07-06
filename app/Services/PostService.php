<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function getPosts(){
        return Post::with('images')->orderBy('created_at', 'DESC')->get();
    }

    public function savePost( string $title,string $content){ //array $images
        DB::transaction(function () use ($title, $content){
            $post = new Post;
            // $post->user_id = $userId;
            $post->title = $title;
            $post->content = $content;
            $post->save();

        // $post = new Post();
        // $post->title = $request->input('title');
        // $post->content = $request->input('content');
        // $post->save();
        // // 画像保存
            // foreach($images as $image){
            //     Storage::putFile('public/images', $image);
            //     $imageModel = new Image();
            //     $imageModel->name = $image->hashName();
            //     $imageModel->save();
            //     $post->images()->attach($imageModel->id);
            // }
        });
    }



}