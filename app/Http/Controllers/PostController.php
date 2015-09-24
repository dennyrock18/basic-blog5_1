<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use App\User;
use Illuminate\Http\Request;
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
        //**********************************************************************
        if (Gate::denies('update', $post)) {
            Alert::danger('No tienes permisos para editar este post');
            return redirect('posts');
        }
        //**********************************************************************

        return $post->title;
    }

    public function destroy($id, Request $request)
    {
        $post = Post::find($id);

        //Regla para saber si el user conectado tiene permiso para eliminar el pos seleccionado
        //**********************************************************************
        if (Gate::denies('update', $post)) {
            Alert::danger('No tienes permisos para eliminar este post');
            return redirect('posts');
        }
        //**********************************************************************

        $post->delete();

        $message = 'El Post: ' . $post->title . ' del User: '. $post->user->name .' fue eliminado de nuestro registro';

        if($request->ajax())
        {
            return response()->json([
                'id' => $post->id,
                'message' => $message
            ]);
        }
        Alert::success($message);
        return redirect('posts');
    }
}
