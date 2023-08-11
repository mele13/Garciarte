@extends('layout')

@section('additional_links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/uploadImage.css') }}" />
@endsection

@section('content')
<div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
    </div>
@endsection