<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){

        $posts = Post::when(request('category_id') != '', function($query){
                $query->where('category_id',request('category_id'));
        } )->paginate(3);
        return PostResource::collection($posts);
        //return PostResource::collection(Post::paginate(3));
        //return PostResource::collection(response()->json(Post::all()));
        //return PostResource::collection(Post::all());
        //return Post::all();
    }

}
