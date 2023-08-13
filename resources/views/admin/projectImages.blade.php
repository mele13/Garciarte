@extends('layout')

@section('additional_links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/imageManager.css') }}" />
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="px-lg-5">
        <div class="row">
            @foreach($images as $image)            
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <img src="{{ route('image.show', $image->filename) }}" alt="{{ $image->filename }}" class="img-fluid card-img-top">
                    <div class="p-4">
                        <!-- Título -->
                        <!-- <h5>Red paint cup</h5> -->
                        <!-- Descripción -->
                        <!-- <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                        <!-- Badges -->
                        <!-- <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                            <p class="small mb-0">
                                <i class="fa fa-picture-o mr-2"></i>
                                <span class="font-weight-bold">JPG</span>
                            </p>
                            <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                        </div> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
