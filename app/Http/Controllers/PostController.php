<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        return view('index');

    }

    public function add(){
        return view('admin.posts.add');
    }

    public function edit($id){
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', ['post' => $post, 'categories'=>$categories]);
    }

    public function update($id){
        $image = $request->file('img');
        $image_img = $image->getClientOriginalName();

        $post = Post::find($id);

        $post->post_title = $request->title;
        $post->category_id =$request->category_id;
        if (!empty($image_img)) $post->img = $image_img;
        $post->content =$request->content;
        $post->save();
        $this->uploadImg($request, $post->id);

        return back()->with(['message', 'Post Updated Succesfully']);




    }

    public function store(Request $request){
        $image_img = " ";

        if($request->hasFile('img'))
        {

        $image = $request->file('img');
        $image_img = $image->getClientOriginalName();

        }
        $post = new Post();
        $post->post_title =$request->post_title;
        $post->category_id =$request->category_id;
        $post->img =$image_img;
        $post->content =$request->content;
        $post->save();
        $this->uploadImg($request, $post->id);

        return back()->with(['message', 'Post Added Succesfully']);



    } 



    public function uploadImg(Request $request, $post_id){
        if($request->hasFile('img'))
        {
            $path = public_path("post_images/post_$post_id");
            if (! file_exists($path) )
            {
                mkdir($path, 0777, true);
            }

            $image = $request->file('img');
            $image_img = $image->getClientOriginalName();
            $image->move($path, $image_img);
        }
        
    }


    // lists all post on the admin dashboard
    public function adminIndex(){
        
        $posts = Post::all();
        return view('admin.posts.index',["posts"=>$posts]);
    }

}
