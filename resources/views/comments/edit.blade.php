@extends('layouts.app')

@section('title','Edita Comentario')

@section('content')

    <div class="panel panel-default">
        <div class="panel-content">

            {{ $comment->content }}
        </div>
    </div>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="note_id" value="{{ $comment->note->id }}">
        <div class="form-group">
            <textarea class="form-control" name="content" id="" cols="60" rows="3">
                {{ $comment->content }}
            </textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Editar</button>
        </div>

    </form>

@endsection
