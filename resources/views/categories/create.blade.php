
@extends('layouts.app')

@section('title', 'Crear nueva categoria')

@section('content')

    <form action="{{ route('storeCategory') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="text" name="name" class="form-control" autofocus required value="{{ old('name') }}">

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-default">Agregar</button>
        </div>


    </form>

    @endsection