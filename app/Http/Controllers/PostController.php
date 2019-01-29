<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;
use Validator;


class PostController extends Controller
{
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [ 
        'title' => 'required', 
        'body' => 'required'
      ]);
      if ($validator->fails()) { 
          return response()->json(['error'=>$validator->errors()], 401);            
      }
      $post = new Post([
        'title' => $request->get('title'),
        'body' => $request->get('body')
      ]);

      $post->save();

      return response()->json('successfully added');
    }

    public function index()
    {
      return new PostCollection(Post::all());
    }

    public function edit($id)
    {
      $post = Post::find($id);
      return response()->json($post);
    }

    public function update($id, Request $request)
    {
      $validator = Validator::make($request->all(), [ 
        'title' => 'required', 
        'body' => 'required'
      ]);
      if ($validator->fails()) { 
          return response()->json(['error'=>$validator->errors()], 401);            
      }

      $post = Post::find($id);

      $post->update($request->all());

      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $post = Post::find($id);

      $post->delete();

      return response()->json('successfully deleted');
    }
}
