<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::all();
    return view('users.index', ['users' => $users]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('users.create');
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
      'email' => 'required|email|unique:users',
      'name' => 'required',
      'password' => 'required|confirmed|min:6',
    ]);

    $user = User::create($request->all());
    if ($user)
      return redirect('/users')->with('create', true);
    else
      return redirect('/users')->with('create', false);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    return view('users.show', ['user' => $user]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('users.edit', ['user' => $user]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {

    $request->validate([
      'email'  =>  'required|email|unique:users,email,' . $user->id,
      'name' => 'required',
      'password' => 'nullable|confirmed|min:6',
    ]);
    if ($request->password)
      $update = $user->update($request->all());
    else
      $update = $user->update([
        "name" => $request->name,
        "email" => $request->email,
      ]);
    if ($update)
      return redirect('/users')->with('update', true);
    else
      return redirect('/users')->with('update', false);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->comments()->delete();
    $user->posts()->delete();
    $delete = $user->delete();
    if ($delete)
      return redirect('/users')->with('delete', true);
    else
      return redirect('/users')->with('delete', false);
  }
}
