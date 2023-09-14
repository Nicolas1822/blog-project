<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function index()
  {
    $user_id = Auth::id();
    // Post::latest()->paginate()
    $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
      ->select('posts.*')
      ->where('users.id', '=', $user_id)
      ->latest() // Ordena los resultados por 'created_at' en orden descendente
      ->paginate(); // Pagina los resultados
    return view(
      'posts.index',
      ['posts' => $posts]
    );
  }

  public function create(Post $post)
  {
    return view('posts.create', ['post' => $post]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'slug' => 'required|unique:posts,slug',
      'body' => 'required',
    ]);

    $post = $request->user()->posts()->create([
      'title' => $request->title,
      'slug' => $request->slug,
      'body' => $request->body,
    ]);
    return redirect()->route('posts.index');
  }

  public function edit(Post $post)
  {
    return view('posts.edit', ['post' => $post]);
  }

  public function update(Request $request, Post $post)
  {
    $request->validate([
      'title' => 'required',
      'slug' => 'required|unique:posts,slug,' . $post->id,
      'body' => 'required',
    ]);

    $post->update([
      'title' => $request->title,
      'slug' => $request->slug,
      'body' => $request->body,
    ]);
    return redirect()->route('posts.index');
  }

  public function destroy(Post $post)
  {
    $post->delete();

    return back();
  }
}
