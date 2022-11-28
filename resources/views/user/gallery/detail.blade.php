@extends('layouts.user')

@section('title')
    {{ $gallery->title }}
@endsection

@push('seo')
    {{-- Facebook Meta Tag --}}
    <meta property="og:site_name" content="JDIH Bone Bolango">
    <meta property="og:title" content="{{ $gallery->title }}" />
    <meta property="og:description" content="{{ $gallery->title }}" />
    <meta property="og:image" itemprop="image" content="{{ asset('storage/upload/galeri/' . $gallery->thumbnail()->file) }}">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ route('detail-galeri', $gallery->slug) }}" />
@endpush

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="overlay news d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Galeri</h1>
        </div>
    </div>

    <!-- Section Detail Gallery -->
    <section class="detail-gallery">
        <div class="container">
            <div class="heading">
                <small><i class='bx-pull-left bx bx-calendar-event bx-sm'></i>
                    {{ $gallery->created_at }}</small>
                <h3>{{ $gallery->title }}</h3>
                <h6 style="color: ##000D4B;">{{ $gallery->description }}</h6>
            </div>
            <div class="content">
                <!-- Carousel wrapper -->
                <div id="carouselMultiGallery" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <!-- Slides -->
                    <div class="carousel-inner mb-5">
                        @foreach ($gallery->photos as $data)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/upload/galeri/' . $data->file) }}" class="d-block w-100"
                                    alt="kegiatan" />
                            </div>
                        @endforeach
                    </div>
                    <!-- Slides -->

                    <!-- Thumbnails -->
                    <div class="carousel-indicators" style="margin-bottom: -200px;">
                        @foreach ($gallery->photos as $data)
                            <button type="button" data-bs-target="#carouselMultiGallery"
                                data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                                aria-current="true" aria-label="Slide {{ $loop->iteration }}">
                                <img src="{{ asset('storage/upload/galeri/' . $data->file) }}" />
                            </button>
                        @endforeach
                    </div>
                    <!-- Thumbnails -->
                </div>
                <!-- Carousel wrapper -->
            </div>
            <div class="social-media">
                <p>Bagikan di</p>
                <div id="social-links">
                    <ul>
                        {!! Share::currentPage()->facebook() !!}
                        {!! Share::currentPage()->whatsapp() !!}
                        {!! Share::currentPage()->twitter() !!}
                        {!! Share::currentPage()->telegram() !!}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Detail Gallery-->

    <hr>

    <!-- Section Related Gallery -->
    <section class="related-gallery">
        <div class="container">
            <h3>Foto Kegiatan Lainnnya</h3>
            <div class="row">
                @foreach ($fourGallery as $gallery)
                    <div class="col-lg-4 mb-3">
                        <div class="content">
                            <div class="card">
                                <a href="{{ route('detail-galeri', $gallery->slug) }}">
                                    <img src="{{ asset('storage/upload/galeri/' . $gallery->thumbnail()->file) }}"
                                        alt="kegiatan">
                                    <p>{{ $gallery->title }}</p>
                                    <small><i class='bx-pull-left bx bx-calendar-event bx-sm'></i>
                                        {{ $gallery->created_at }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Section Related Gallery -->
@endsection
