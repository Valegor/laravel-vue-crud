<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){
        //return PostResource::collection(response()->json(Post::all()));
        return PostResource::collection(Post::all());
        //return Post::all();
    }

    // public function index(){
    //     return response()->json(Post::all());
    //     // return Post::all();
    // }

    // public function posts(){
    //     return response()->json(Post::all());
    //     // return Post::all();
    // }

    // public function country() {
    //     return response()->json(CountryModel::get(), 200);
    // }
}
