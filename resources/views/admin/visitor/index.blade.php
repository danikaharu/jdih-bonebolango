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
                        <div class="card-title">5 Berita Terpopuler</div>
                        {{-- @forelse($visitGallery as $data)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10">
                                            <a href="{{ route('admin.gallery.show', $data->slug) }}" target="blank">
                                                {{ $data->title }}
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <span class="badge badge-center bg-primary rounded-pill">
                                                {{ visits($data)->count() }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @empty
                            Maaf, belum ada data
                        @endforelse --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">5 Galeri Terpopuler</div>
                        {{-- @forelse($visitGallery as $data)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10">
                                            <a href="{{ route('admin.gallery.show', $data->slug) }}" target="blank">
                                                {{ $data->title }}
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <span class="badge badge-center bg-primary rounded-pill">
                                                {{ visits($data)->count() }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @empty
                            Maaf, belum ada data
                        @endforelse --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
