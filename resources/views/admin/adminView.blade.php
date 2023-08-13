@extends('layout')

@section('additional_links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/imageManager.css') }}" />
@endsection

@section('content')
<div>
    <a href="{{ route('images.showAll') }}">Gestor de imágenes</a><br>
    <a href="#">Administrar imágenes del caroussel</a><br>
    <a href="#">Administrar imágenes de la galeria</a>
</div>
@endsection