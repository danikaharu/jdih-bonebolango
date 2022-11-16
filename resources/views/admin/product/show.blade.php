@extends('layouts.admin')

@section('title')
    Produk Hukum
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Produk Hukum
        </h4>

        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.product.index') }}"><i
                        class="bx bx-arrow-back me-1"></i>
                    Kembali</a></li>
        </ul>

        <div class="card">
            <div class="card-body">
                <table class="table table-responsive-sm table-hover table-bordered"">
                    <thead>
                        <tr>
                            <th scope=" col">Nama</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Jenis Peraturan</strong></td>
                            <td>{{ $product->category->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor Peraturan</strong></td>
                            <td>{{ $product->rule_number }}</td>
                        </tr>
                        <tr>
                            <td><strong>Judul</strong></td>
                            <td>{{ $product->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Ditetapkan</strong></td>
                            <td>{{ $product->determination_date }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="badge bg-label-primary">Mengubah</span>
                                @elseif($product->status == 2)
                                    <span class="badge bg-label-info">Diubah</span>
                                @elseif($product->status == 3)
                                    <span class="badge bg-label-warning">Mencabut</span>
                                @else
                                    <span class="badge bg-label-danger">Dicabut</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>File</strong></td>
                            <td>
                                <a href="{{ asset('storage/upload/produk/' . $product->file) }}" target="pdf-frame"
                                    class="btn btn-dark btn-sm">
                                    <i class="bx bxs-file-pdf">
                                        Lihat File
                                    </i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
