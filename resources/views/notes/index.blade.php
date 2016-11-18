@extends('layouts.app')

@section('title', 'Listado de Notas')

@section('content')

<div class="panel">

    <p align="center">
    <form class="form-inline" action = "{{ route('indexNote') }}">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i fa fa-search-fa></i></div>
                <input type="text" class="form-control" name="search" placeholder="Buscar nota">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    </p>
</div>
<table class ="table table-responsive">
    <thead>
        <th>ID</th>
        <th>TITULO</th>
        <th>CATEGORIA</th>
        <th>AUTOR</th>
        <th>CREACION</th>
    </thead>
    <tbody>
        @foreach($notes as $note)
            <tr>
                <td>
                    {{ $note->id }}
                </td>
                <td>
                    @if ($note->ownerOfNote()) 
                        <b> <a href="{{ route('viewNote',$note->id) }}">{{ $note->title }} </a> </b>
                    @else 
                        <a href="{{ route('viewNote',$note->id) }}">{{ $note->title }} </a> 
                    @endif

                </td>
                <td>
                    <a href="{{ route('viewCategory', $note->category->id ) }}">{{ $note->category->name }}</a>
                </td>
                <td>
                    {{ $note->user->name }}
                </td>
                <td>
                    {{ $note->created_at->format('d-m-Y')}}
                </td>
            </tr>                                
        @endforeach
    </tbody>
</table>
{{ $notes->render() }}
Hay: {{ $notes->perPage() }}
-- Ultima:{{ $notes->lastpage() }}

@endsection