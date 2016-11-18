
@extends('layouts.app')

@section('title', 'Editar categoria')

@section('content')

    <form action="{{ route('updateCategory', $category->id) }}" method="POST">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" autofocus required value="{{ old('name') }}">

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-default">Editar</button>
        </div>


    </form>

@endsection