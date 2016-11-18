@extends('layouts.app')

@section('title',$note->title)

@section('content')
	@if ($note->ownerOfNote())
		<div class="pull-right"> 
			<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete">
				 <i class="fa fa-trash-o"></i>
			</button>

			<a class="btn btn-success btn-xs" href="{{ route('editNote', $note->id) }}"><i class="fa fa-pencil-square-o"></i></a>	
			</div>
			<!-- MODAL -->
			<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        
			      </div>
			      <div class="modal-body">
			        ¿Estas seguro que deseas borrar la nota <b>{{ $note->title }} </b>? 
			      </div>
				  	
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <form action="{{ route('destroyNote', $note->id) }}" method="POST" style="display:inline-block;">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE">
						<button rol="submit" class="btn btn-danger">Borrar</button>
					</form>
			      </div>
			    </div>
			  </div>
			</div>
	@endif

	<!-- {{ " esto no interpreta html tags" }} -->
	<!-- {!! "esto si interpreta html tags" !!} -->

	{!! $note->content !!}

	<small>
		<hr>
		<label for="">Categoria: {{ $note->category->name }} || </label>
		Publicado por <b>{{ $note->user->name }}</b>
		<span class="pull-right"> {{ $note->created_at->diffForHumans() }} </span>
	</small>

	<hr>
	<h4>Comentarios</h4>

	@foreach($note->comments->sortByDesc('updated_at') as $comment) <!-- ESTA ES UNA COLECCION //  todos los comentarios de las notas seran almacenados en la variable comment -->

			<div class="panel panel-default">
			<div class="panel-content" style="padding:10px;">
				{{ $comment->content }}
				@if ($comment->ownerOfComment())
					<div class="pull-right">
						<a href=" {{ route('comments.edit', $comment->id) }}" type="button" class="btn btn-danger btn-xs">
							<i class="fa fa-pencil-square-o"></i>
						</a>
						<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDeleteComment">
							<i class="fa fa-trash-o"></i>
						</button>
					</div>
					<!-- MODAL -->
					<div class="modal fade" id="modalDeleteComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

								</div>
								<div class="modal-body">
									¿Estas seguro que deseas borrar el comentario <b>{{ $comment->content }} </b>?
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
										{{ csrf_field() }}
										<input type="hidden" name="_method" value="DELETE">
										<button rol="submit" class="btn btn-danger">Borrar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endif
			<small >
				<br>Creado hace: <span> {{ $comment->created_at->diffForHumans() }} </span> por: {{ $comment->user->name }}

			</small>
				</div>
		</div>

	@endforeach

	<form action="{{ route("comments.store") }}" method="POST">
		{{ csrf_field() }}
		<input type="hidden" value="{{ $note->id }}" name="note_id">
		<div class="form-group">
			<textarea class="form-control" name="content" id="" cols="60" rows="3"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Agregar</button>
		</div>
	</form>



@endsection
