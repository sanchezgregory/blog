<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index () {
        $categories = Category::paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create ()  // este metodo es para mostrar el formulario.
    {
        return view('categories.create'); // debe haber un directorio categories y dentro un archivo create.blade.php
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:categories|required|min:4|max:50'
        ]);

        Category::create($request->all());

        flash('Categoria creada con exito', 'success'); // muestra un message del paquete flash (helper laracasts flash)

        return redirect()->route('indexCategory');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id); // almaceno en variable para poder mostrar quehe borrado

        if ($category->notes->count()) {
            flash("No se puede borrar una categoria con notas");
        } else {

            $category->delete(); // ahora si la puedo borrar pero mantengo todo guardado
            flash("Usted ha eliminado a la categoria $category->name", "danger"); // aqui si la puedo mostrar

        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'name' => "required|unique:categories,name,{$id}|min:4|max:50" // name, {id} => lo hace unico pero no con ese id
        ]);

        $category = Category::findOrFail($id); // primero lo guardo en la variable para mostrar el nombre anterior

        $category->update($request->all()); // despues si lo puedo modificar

        flash("Usted ha editado la categoria $category->name");

        return redirect()->action('CategoriesController@view', [
            'id' => $id
        ]);
    }

    public function view($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.view', compact('category'));
    }
}