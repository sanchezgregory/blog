@extends('layouts.app')

@section('title',$category->name)

@section('content')
    <div class="pull-right"> <b>Notas en esta categoria:</b> {{ $category->notes->count() }}</div>
    <h3>Listado de Notas</h3>
    <ul class="list-group">
        @foreach($category->notes()->paginate(10) as $note)
            <li class="list-group-item">
                <div class="label label-info">{{ $note->category->name }}</div> <a href="{{ route('viewNote', $note->id) }}"> {{ $note->title }} </a>
            </li>
        @endforeach

        <!-- genera paginacion -->
        {!! $category->notes()->paginate(10) !!}
    </ul>
@endsection