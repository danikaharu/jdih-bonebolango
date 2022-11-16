@extends('layouts.admin')

@section('title')
    Permintaan Peraturan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Permintaan Peraturan
        </h4>

        <div class="card">
            <h5 class="card-header">Tambah Permintaan Peraturan</h5>

            <div class="card-body">
                <form action="{{ route('admin.request-product.store') }}" method="POST">
                    @csrf

                    @include('admin.request-product.include.form')

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
