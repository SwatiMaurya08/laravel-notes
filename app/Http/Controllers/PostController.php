<?php

namespace App\Http\Controllers;

use App\Like;
use App\post;
use App\Tag;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function getIndex()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('blog.index', ['posts' => $posts]);

    }

    public function getAdminIndex()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('title', 'desc')->get();
        return view('admin.index', ['posts' => $posts]);

    }

    public function getPost($id)
    {
        // $post = Post::find($id);
        $post = Post::where('id', $id)->with('likes')->first(); //This is alternative  to  find method
        return view('blog.post', ['post' => $post]);

    }

    public function getLikePost($id)
    {
        // $post = Post::find($id);
        $post = Post::where('id', $id)->first(); //This is alternative  to  find method
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();

    }

    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit($id)
    {
        $tags = Tag::all();
        $post = Post::find($id);
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);

    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5'
        ]);
        $user = Auth::user();

        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
       $user->posts()->save($post);

        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post Created , Title is: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5'
        ]);
        $post = Post::find($request->input('id'));
        if(Gate::denies('manipulate-post' , $post)){
            return redirect()->back();
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        //   $post->tags()->detach();
        //   $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post Edited , New Title is: ' . $request->input('title'));
    }

    public function getAdminDelete($id)
    {
        $post = Post::find($id);
        if(Gate::denies('manipulate-post' , $post)){
            return redirect()->back();
        }
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info', 'Post Deleted!!!');

    }

}
