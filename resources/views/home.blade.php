@extends('layouts.app')

@section('title', 'Home')

@section('content')
    
<h2>Bienvenido</h2> <h3> {{ Auth::user()->name }} </h3>

@endsection
