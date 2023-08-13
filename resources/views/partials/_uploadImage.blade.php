@extends('layout')

@section('additional_links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/imageManager.css') }}" />
@endsection

@section('content')
<div id="content">
    @if(session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
    @endif

    @if(session('errorMessage'))
    <div class="alert alert-danger">
        {{ session('errorMessage') }}
    </div>
    @endif

    <form method="POST" action="{{ route('upload.image') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input class="form-control" type="file" name="uploadfiles[]" accept=".jpg,.jpeg,.png" multiple/>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="upload">SUBIR</button>
        </div>
    </form>
</div>
@endsection
