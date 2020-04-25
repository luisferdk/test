<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::with('user', 'comments')->orderBy('id', 'desc')->get();
    $users = User::all();
    return view('posts.index', ['posts' => $posts, 'users' => $users]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $users = User::all();
    return view('posts.create', ['users' => $users]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|min:6',
      'description' => 'required|string|min:10',
      'user_id' => 'required|integer',
    ]);

    $post = Post::create($request->all());
    return redirect('/posts')->with('create', true);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    $users = User::all();
    return view('posts.show', ['post' => $post, 'users' => $users]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    $users = User::all();
    return view('posts.edit', ["post" => $post, 'users' => $users]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    $request->validate([
      'title' => 'required|string|min:6',
      'description' => 'required|string|min:10',
      'user_id' => 'required|integer',
    ]);

    $update = $post->update($request->all());
    if ($update)
      return redirect('/posts')->with('update', true);
    else
      return redirect('/posts')->with('update', false);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    $post->comments()->delete();
    $delete = $post->delete();
    if ($delete)
      return redirect('/posts')->with('delete', true);
    else
      return redirect('/posts')->with('delete', false);
  }
}
