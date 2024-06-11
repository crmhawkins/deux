@extends('layouts.app')

@section('title', 'Ver Textos de documentos')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
<div>
    @livewire('textos.index-component')
</div>
@endsection
