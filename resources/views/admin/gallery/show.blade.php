@extends('layouts.admin')

@section('title')
    Galeri
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Galeri
        </h4>

        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.gallery.index') }}"><i
                        class="bx bx-arrow-back me-1"></i>
                    Kembali</a></li>
        </ul>

        <div class="card">
            <div class="card-body">
                <table class="table table-responsive-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Judul</strong></td>
                            <td>{{ $gallery->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi</strong></td>
                            <td>{{ $gallery->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Gambar</strong></td>
                            <td>
                                @foreach ($gallery->photos as $data)
                                    <img class="mb-3" src="{{ asset('storage/upload/galeri/' . $data->file) }}"
                                        alt="kegiatan" width="300">
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
