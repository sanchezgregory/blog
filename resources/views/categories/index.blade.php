
@extends('layouts.app')

@section('title', 'Listado de Categorias')

@section('content')


    <table class ="table table-responsive">
        <thead>
        <th>ID</th>
        <th>CATEGORIA</th>
        <th>NOTAS</th>
        <th>CREACION</th>
        @if (Auth::user()->type == "Admin")
            <th>ACCION</th>
        @endif
        </thead>
        <tbody>

          <!-- dd(Auth::user()->notes->where('category_id', 1)) -->

        @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->id }}
                </td>
                <td>
                    {{ $category->name }}
                </td>
                <td>
                    {{ $category->notes->count() }}
                </td>
                <td>
                    {{ $category->created_at->format('d-m-Y') }}
                </td>
                @if (Auth::user()->type == "Admin")
                    <td>
                            <a href=" {{ route('viewCategory', $category->id) }}"  class="btn btn-default btn-xs">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href=" {{ route('editCategory', $category->id) }}"  class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete-{{ $category->id }}">
                                <i class="fa fa-trash-o"></i>
                            </button>

                        <div class="modal fade" id="modalDelete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro que deseas borrar la categoria <b>{{ $category->name }} su id es {{ $category->id }}</b>?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="{{ route('destroyCategory', $category->id) }}" method="POST" style="display:inline-block;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button rol="submit" class="btn btn-danger">Borrar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{ $categories->render() }}
    Hay: {{ $categories->perPage() }}
    -- Ultima:{{ $categories->lastpage() }}



@endsection