<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Comment::create([
            'user_id' => auth()->user()->id,
            'note_id' => $request->note_id,
            'content' => $request->content,
        ]);
        flash("Agregado con exito", "success");

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments/edit')->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all()); // almaceno en comment el objeto comment. y aqui tengo el id de la nota mediante la relacion

        flash("El comentario ha sido editado excitosamente");

        return redirect()->route('viewNote', $comment->note->id); // gracias a que tengo el objeto comment traigo mi id de nota.
        //return back();
        //return redirect()->route('viewNote', $request->note_id); // de esta manera tbn me traigo el id de la nota desde el formulario con hidden input.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        Comment::findOrFail($id)->delete();

        flash("El comentario {{ $comment->content }} ha sido eliminado", 'danger');

        return back(); // regreso a la nota
        //return redirect()->route('indexNote'); // regreso a todas las notas
    }

    public function restore(Request $request, $id)
    {
        $comment = Comment::withTrashed()->find($id);

        $comment->restore();

        flash('El comentario ha sido restaurado', 'success');

        // return back();
        return redirect()->route('viewNote', $comment->note->id);

    }
}
