@extends('layouts.app')

@section('title', 'Editar/Ver Textos de documentos')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
<div>
    @livewire('textos.edit-component', ['identificador'=>$id])
</div>
@endsection

