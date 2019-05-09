<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function post(){
        
    }
    public function addPost(Request $request){
    $this->validate($request, [
        'post_title'=> 'required',
        'post_body'=> 'required',
        'post_image'=> 'required',

    ]);
    $posts = new Post;
    $posts->post_title = $request->input('post_title');
    $posts->user_id = Auth::user()->id;
    $posts->post_body = $request->input('post_body');
    
    if(Input::hasFile('post_image')){
        $file = Input::file('post_image');
$file->move(public_path(). '/posts',
$file->getClientOriginalName());
$url = URL::to("/") . '/posts/' .
        $file->getClientOriginalName();
    }
    $posts->post_image = $url;
    $posts->save();
    return redirect('/home')->with('response', 'Profile Added Succesfully');
    }
}
