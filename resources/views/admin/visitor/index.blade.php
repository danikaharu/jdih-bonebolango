@extends('layouts.admin')

@section('title')
    Pengunjung
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">5 Produk Hukum Terpopuler</div>
                        @forelse($popularProduct->table as $data)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10">
                                            <a href="{{ url($data['pagePath']) }}" target="blank">
                                                {{ $data['pageTitle'] }}
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <span class="badge badge-center bg-primary rounded-pill">
                                                {{ $data['screenPageViews'] }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @empty
                            Maaf, belum ada data
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Total Pengunjung</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row my-2">
                                    <div class="col-10">
                                        <a href="#" target="blank">
                                            Hari Ini
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <span class="badge badge-center bg-primary rounded-pill">
                                            {{ $totalUsersPerDay }}</span>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-10">
                                        <a href="#" target="blank">
                                            Bulan Ini
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <span class="badge badge-center bg-primary rounded-pill">
                                            {{ $totalUsersPerMonth }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">10 Halaman Terpopuler (30 Hari Terakhir)</div>
                    @forelse($mostViewsByPage as $data)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-10">
                                        <a href="{{ url(str_replace(config('app.url'), '', $data['fullPageUrl'])) }}"
                                            target="blank">
                                            {{ $data['pageTitle'] }}
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <span class="badge badge-center bg-primary rounded-pill">
                                            {{ $data['screenPageViews'] }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @empty
                        Maaf, belum ada data
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
