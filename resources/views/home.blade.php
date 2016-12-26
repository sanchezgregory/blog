@extends('layouts.app')

@section('title', 'Home')

@section('content')
    
<h2>Bienvenido</h2> <h3> {{ Auth::user()->name }} </h3>

<img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="" class="img-responsive" width="80" height="80">

    @if (! auth()->user()->avatar == 'avatars/default.png')
        <a  href="{{ route('deleteimg') }}" class="btn-primary" >Borrar imagen</a>
    @endif

@endsection
