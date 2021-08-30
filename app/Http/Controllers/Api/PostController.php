<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return response()->json(Post::all());
        // return Post::all();
    }

    // public function posts(){
    //     return response()->json(Post::all());
    //     // return Post::all();
    // }

    // public function country() {
    //     return response()->json(CountryModel::get(), 200);
    // }
}
