<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;
use Validator;


class PostController extends Controller {

	public function store( Request $request ) {
		$validator = Validator::make(
			$request->all(),
			[
				'title' => 'required',
				'body'  => 'required',
			]
		);
		if ( $validator->fails() ) {
			return response()->json( [ 'error' => $validator->errors() ], 401 );
		}
		$post = new Post(
			[
				'title' => $request->get( 'title' ),
				'body'  => $request->get( 'body' ),
			]
		);

		$post->save();

		return response()->json( 'successfully added' );
	}

	public function index( Request $request ) {
		$query   = $request->get( 'query' ) !== '' ? $request->get( 'query' ) : false;
		$limit   = $request->get( 'limit' ) !== '' ? $request->get( 'limit' ) : 10;
		$sort    = $request->get( 'ascending' ) === '0' ? 'DESC' : 'ASC';
		$orderby = $request->get( 'orderBy' ) !== '' ? $request->get( 'orderBy' ) : false;
		
		$post = new Post();
		if ( $query ) {
			$post = $post->where( 'title', 'like', '%' . $query . '%' )
			->orWhere( 'body', 'like', '%' . $query . '%' );
		}
		if ( $orderby ) {
			$post = $post->orderBy( $orderby, $sort );
		}

		$posts = $post->paginate( $limit )->toArray();

		return response()->json(
			[
				'data'  => $posts['data'],
				'count' => $posts['total'],
			]
		);

	}

	public function edit( $id ) {
		$post = Post::find( $id );
		return response()->json( $post );
	}

	public function update( $id, Request $request ) {
		$validator = Validator::make(
			$request->all(),
			[
				'title' => 'required',
				'body'  => 'required',
			]
		);
		if ( $validator->fails() ) {
			return response()->json( [ 'error' => $validator->errors() ], 401 );
		}

		$post = Post::find( $id );

		$post->update( $request->all() );

		return response()->json( 'successfully updated' );
	}

	public function delete( $id ) {
		$post = Post::find( $id );

		$post->delete();

		return response()->json( 'successfully deleted' );
	}
}
