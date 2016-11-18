@extends('layouts.app')

@section('title', 'Crear nueva nota')

@section('content')
	
<form action="{{ route('storeNote') }}" method="post" >
	{!! csrf_field() !!}
    <div class="form-group">
    	<label for="title">Titulo</label>
    	<input type="text" id="title" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="title">Categoria</label>
        <select name="category_id" id="category"> <!-- para guardar automaticamente el select lo llamo del mismo nombre como en la tabla. category_id  -->
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group">
    	<label for="title">Contenido</label>
    	<textarea cols="20" id="title" name="content" class="form-control" required> </textarea>

    </div>

    <div class="form-group">
    	<button type="submit" class="btn btn-primary">Enviar</button>
    	
    </div>
</form>

@endsection