<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Auth;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Category;


class NotesController extends Controller
{

	public function index(Request $request)
	{
        $notes = Note::searchTitle($request->search)->orderBy('id','desc')->paginate(15);

        if (isset($request->search) && empty($request->search) ) {
            return redirect()->to('/notes');
        }
		return view('notes.index',compact('notes'));
	}

	public function create() 
	{
        $categories = Category::all(); // para mostrar las categorias en la vista de crear notas

		return view('notes/create', compact('categories'));
	}

	public function store(StoreNoteRequest $request) 
	{
		// Note::create($request->all()); // no se hace porque me falta el id del usuario


		$note = new Note($request->all());
		$note->user_id = Auth::user()->id;
		$note->save();

		flash('Nota Creada con exito', 'success');

		return redirect()->route('indexNote');
	}

	public function view ($id)
	{
		$note = Note::findOrFail($id);

		return view('notes/view', compact('note')); // compact recibe string con el nombre de la variable para mandar lo que contenga la variable $note
	}

	public function destroy($id)
	{
		$note = Note::findOrFail($id);
		Note::findOrFail($id)->delete();

		flash("La nota <b>{$note->title}</b> fue eliminada con exito", 'danger');

		return redirect()->route('indexNote');
	}

	public function edit ($id) 
	{
		$note = Note::findOrFail($id);

		return view('notes/edit')->with('note', $note);  // esta es la otra forma cuando no quieres usar compact.
	}

	public function update (UpdateNoteRequest $request, $id) // este es el request general
	{
		
		// una forma es--->
		Note::findOrFail($id)->update($request->all());

		/* otra forma es ---->
		Note::findOrFail($id)->update([
			'title' => $request->title,
			'content' =>$request->content
			]);
		*/

		flash("La nota <b>{$request->title}</b> fue editada correctamente", 'success');

		return redirect()->route('viewNote', $id);
	}
}