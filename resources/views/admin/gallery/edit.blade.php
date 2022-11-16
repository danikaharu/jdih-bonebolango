@extends('layouts.admin')

@section('title')
    Galeri
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Galeri
        </h4>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header">Edit Galeri</h5>

                    <div class="card-body">
                        <form action="{{ route('admin.gallery.update', $gallery->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('admin.gallery.include.form')

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @include('admin.gallery.include.formImage')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
