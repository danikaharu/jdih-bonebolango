@extends('layouts.user')

@section('title')
    {{ $news->title }}
@endsection

@push('seo')
    {{-- Facebook Meta Tag --}}
    <meta property="og:site_name" content="JDIH Bone Bolango">
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:description" content="{{ $news->title }}" />
    <meta property="og:image" itemprop="image" content="{{ asset('storage/upload/berita/' . $news->thumbnail) }}">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ route('detail-berita', $news->slug) }}" />
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
            <h1 class="title">Berita</h1>
        </div>
    </div>

    <!-- Section Detail News -->
    <section class="detail-news">
        <div class="container">
            <div class="heading">
                <small><i class='bx-pull-left bx bx-calendar-event bx-sm'></i>
                    {{ $news->created_at }}</small>
                <h3>{{ $news->title }}</h3>
            </div>
            <div class="content">
                <img src="{{ asset('storage/upload/berita/' . $news->thumbnail) }}" alt="berita">
                {!! $news->body !!}
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
    <!-- End Section Detail News-->

    <hr>

    <!-- Section Related News -->
    <section class="related-news">
        <div class="container">
            <h3>Berita Lainnnya</h3>
            <div class="row">
                @foreach ($threeNews as $news)
                    <div class="col-lg-4 mb-3">
                        <div class="berita-content">
                            <div class="card">
                                <a href="{{ route('detail-berita', $news->slug) }}">
                                    <img src="{{ asset('storage/upload/berita/' . $news->thumbnail) }}" alt="berita">
                                    <p>{{ $news->title }}</p>
                                    <small><i class='bx-pull-left bx bx-calendar-event bx-sm'></i>
                                        {{ $news->created_at }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Section Related News -->
@endsection

@push('scripts')
    <script src="{{ asset('js/share.js') }}"></script>
@endpush
