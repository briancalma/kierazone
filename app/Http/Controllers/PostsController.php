<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    public function index()
    {
        # $posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title' => 'required','body' => 'required','cover_image' => 'image|nullable|max:1999']);
        
        # Cover Image Process
        if($request->hasFile('cover_image'))
        {
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName."__".time().".".$extension;
            $path = $request->file('cover_image')->storeAs('public/coverImages',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body =  $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        
        if($post->save())
        {
            if(!(auth()->check()))
                return redirect('post')->with('success','Sucess In Adding a New Post!');
            else 
                return redirect('dashboard')->with('success','Sucess In Adding a New Post!');
        }

        return redirect('post/create')->with('error','Cannot Insert a New Post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.view')->with('post',Post::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id != $post->user_id)
            return redirect('/post')->with('error','Error Unauthorized action');

        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request,["title" => "required","body"  => "required","cover_image" => "image|nullable|max:1999"]);
        
        if($request->hasFile('cover_image'))
        {
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName."__".time().".".$extension;

            $path = $request->file('cover_image')->storeAs('public/coverImages/',$fileNameToStore);

            if($post->cover_image != 'noimage.jpg')
                Storage::delete('public/coverImages/'.$post->cover_image);
        }
        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        if($fileNameToStore != "")
            $post->cover_image = $fileNameToStore;

        
        
        if($post->save()) return redirect('post')->with('success','Success In Updating a Record');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        if(auth()->user()->id != $post->user_id)
            return redirect('/post')->with('error','Error Unauthorized action');
     
        Storage::delete('public/coverImages/'.$post->cover_image);

        if($post->delete()) return redirect('post')->with('success','POST REMOVED');

    }
}
