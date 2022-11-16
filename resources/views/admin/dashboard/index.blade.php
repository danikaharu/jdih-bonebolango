@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang, {{ Auth()->user()->name }}!</h5>
                                <p class="mb-4">Kamu memiliki <span
                                        class="fw-bold">{{ $data['notApprovedDiscussion']->count() }}</span> diskusi yang
                                    belum dijawab.
                                    Periksa diskusi di menu diskusi.</p>

                                <a href="{{ route('admin.discussion.index') }}" target="blank"
                                    class="btn btn-sm btn-outline-primary">Lihat
                                    Diskusi</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('template_admin/assets/img/illustrations/man-with-laptop-light.png') }} "
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Kategori</span>
                                <h3 class="card-title mb-1">{{ $data['totalCategory'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Peraturan</span>
                                <h3 class="card-title mb-1">{{ $data['totalProduct'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Berita</span>
                                <h3 class="card-title mb-1">{{ $data['totalNews'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Galeri</span>
                                <h3 class="card-title mb-1">{{ $data['totalGallery'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hasil Survey -->
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-6">
                            <h5 class="card-header m-0 me-2 pb-3">Hasil Survey</h5>
                            <div class="card-body text-center">
                                <h2>{{ $data['averageRating'] }}</h2>
                                @include('admin.dashboard.include.rating')
                                <p>{{ $data['totalSurvey'] }} Penilaian</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-header m-0 me-2 pb-3">Persentase Survey</h5>
                            <div class="table-responsive text-start">
                                <table class="table table-borderless text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Rating</th>
                                            <th>Persentase Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height:10px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ $data['percent5Rating'] }}%"
                                                            aria-valuenow="{{ $data['percent5Rating'] }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="fw-semibold">{{ $data['percent5Rating'] }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height:10px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ $data['percent4Rating'] }}%"
                                                            aria-valuenow="{{ $data['percent4Rating'] }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="fw-semibold">{{ $data['percent4Rating'] }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height:10px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ $data['percent3Rating'] }}%"
                                                            aria-valuenow="{{ $data['percent3Rating'] }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="fw-semibold">{{ $data['percent3Rating'] }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height:10px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ $data['percent2Rating'] }}%"
                                                            aria-valuenow="{{ $data['percent2Rating'] }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="fw-semibold">{{ $data['percent2Rating'] }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height:10px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ $data['percent1Rating'] }}%"
                                                            aria-valuenow="{{ $data['percent1Rating'] }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="fw-semibold">{{ $data['percent1Rating'] }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Hasil Survey -->
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-8 col-xl-8 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-4">
                            <h5 class="m-0 me-2">Interaksi Pengguna</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-start">
                            <table class="table table-borderless text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Jumlah Penggunaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Survey Penggunaan Aplikasi</td>
                                        <td>{{ $data['totalSurvey'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Konsultasi Hukum</td>
                                        <td>{{ $data['totalDiscussion'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Permintaan Peraturan</td>
                                        <td>{{ $data['totalRequestProduct'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-4">
                            <h5 class="m-0 me-2">Katalog Produk Hukum</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @forelse($data['totalProductByCategory'] as $data)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="mb-0">{{ $data->title }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $data->products_count }}</small>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                Maaf, belum ada data
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
