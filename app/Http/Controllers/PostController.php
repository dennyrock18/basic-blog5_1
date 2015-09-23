<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Styde\Html\Facades\Alert;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();

        return view('posts/list', compact('posts'));
    }

    public function edit($id)
    {

        $post = Post::findOrFail($id);

        //A duilio no le gusta mucho porque se pierde la accion si es que no tiene permiso
        //$this->authorize('update-post', $post);

        //Este es el que a el le gusta porque sino tiene permiso lo que hace es retornar a una vista
        // o a donde sea y lanzar una execcion.
        if (Gate::denies('update-post', $post)) {
            Alert::danger('No tienes permisos para editar este post');
            return redirect('posts');
        }

        return $post->title;
    }
}
