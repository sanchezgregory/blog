@extends('layouts.app')

@section('title', "Perfil de usuario")

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="panel col-xs-6 col-md-6">
                <h4> Notas Creadas por el usuario</h4>
                <hr>

                @foreach($notes as $note)
                    <div class="panel panel-success">
                        <br> Nota: {{ $note->title }}
                        <br>Creado el: {{ $note->created_at }}
                    </div>
                @endforeach
                {{ $notes->render() }}
            </div>
            <div class="panel col-xs-6 col-md-6">
                <h4> Comentarios eliminados por el usuario</h4>
                <hr>
                @foreach($comments_disable as $comment)
                    <div class="panel panel-success">
                        Comentario: {{ $comment->content }}
                        <br> Nota: {{ $comment->note->title }}
                        <br>Creado el: {{ $comment->created_at }}
                        <div class="pull-right">
                            <form action="{{ route('comments.restore', $comment) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="PUT" name="_method">
                                <button type="submit" class="btn btn-info btn-xs">Recuperar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection