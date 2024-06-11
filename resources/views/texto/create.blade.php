@extends('layouts.app')

@section('title', 'Textos de documentos')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
<div>
    @livewire('textos.create-component')
</div>
@endsection

