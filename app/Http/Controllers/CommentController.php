<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return redirect('/posts');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $users = User::all();
    $post = Post::find($request->post);
    if ($post)
      return view('comments.create', ["users" => $users, "post" => $post]);
    else
      return redirect('/posts');
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
      'description' => 'required|string|min:4',
      'user_id' => 'required|integer',
      'post_id' => 'required|integer'
    ]);

    $comment = Comment::create($request->all());
    return redirect('/posts')->with('createComment', true);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function show(Comment $comment)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function edit(Comment $comment)
  {
    $users = User::all();
    if ($comment)
      return view('comments.edit', ["users" => $users, "comment" => $comment]);
    else
      return redirect('/posts');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Comment $comment)
  {
    $request->validate([
      'description' => 'required|string|min:4',
      'user_id' => 'required|integer',
      'post_id' => 'required|integer',
    ]);

    $update = $comment->update($request->all());
    if ($update)
      return redirect('/posts')->with('updateComment', true);
    else
      return redirect('/posts')->with('updateComment', false);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $comment)
  {
    $delete = $comment->delete();
    if ($delete)
      return redirect('/posts')->with('deleteComment', true);
    else
      return redirect('/posts')->with('deleteComment', false);
  }
}
