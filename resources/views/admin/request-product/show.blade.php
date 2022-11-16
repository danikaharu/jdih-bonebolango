@extends('layouts.admin')

@section('title')
    Permintaan Peraturan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Permintaan Peraturan
        </h4>

        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.request-product.index') }}"><i
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
                            <td><strong>Nama Pemohon</strong></td>
                            <td>{{ $requestProduct->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Email</strong></td>
                            <td>{{ $requestProduct->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pekerjaan</strong></td>
                            <td>
                                @if ($requestProduct->job == 1)
                                    Pelajar/Mahasiswa/Akademisi
                                @elseif($requestProduct->job == 2)
                                    Profesional
                                @elseif($requestProduct->job == 3)
                                    Wirausaha
                                @else
                                    Pemerintah
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Judul Permohonan Yang Diminta</strong></td>
                            <td>{{ $requestProduct->request_title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tujuan Permohonan</strong></td>
                            <td>
                                @if ($requestProduct->request_purpose == 1)
                                    Referensi Kajian Bisnis
                                @elseif($requestProduct->request_purpose == 2)
                                    Referensi Pembuatan Kebijakan
                                @elseif($requestProduct->request_purpose == 3)
                                    Referensi Pembuatan Kurikulum
                                @elseif ($requestProduct->request_purpose == 4)
                                    Referensi Tugas/Karya Ilmiah
                                @else
                                    Referensi Pribadi
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
