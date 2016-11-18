@extends('layouts.app')

@section('title', "Editar nota: {$note->title}")

@section('content')

	<form action="{{ route('updateNote', $note->id) }}" method="POST" >
	{!! csrf_field() !!}
	<input type="hidden" name="_method" value="PUT">
    <div class="form-group">
    	<label for="title">Titulo</label>
    	<input type="text" id="title" name="title" value="{{ $note->title }}" class="form-control" required>
    </div>
    <div class="form-group">
    	<label for="title">Contenido</label>
    	<textarea cols="20" id="title" name="content"  class="form-control" required> {{ $note->content }}</textarea>

    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary">Editar</button>
    	
    </div>
</form>

@endsection