<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class PostsController extends Controller
{

    // Validation rules
    protected $validations = [
        'title' => 'required|string|max:100',
        'content' => 'required|string'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('admin.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $data = $request->all();

        // Se il metodo è PUT modifico tutto il post, altrimenti aggiorno solo lo stato di pubblicazione
        if ($data['_method'] === 'PUT') {

            // Validazione
            $request->validate($this->validations);

            // Se cambia il titolo
            if ( $post->title != $data['title'] ) {

                $post->title = $data['title'];
            
                $slug = Str::of($post->title)->slug('-');
    
                // Se cambia lo slug
                if ($post->slug != $slug) {
    
                    $i = 1;
                    while ( Post::where('slug', $slug)->first() ) {
                        
                        $slug = Str::of($post->title)->slug('-') . "-{$i}";
                        $i++;
                        
                    }
                    
                    $post->slug = $slug;
    
                }

            }
            
        }
        
        $post->published = isset( $data['published'] );
        
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Cancellazione post
        $post->delete();

        return redirect()->route('posts.index');
    }
}
