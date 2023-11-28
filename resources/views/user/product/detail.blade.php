@extends('layouts.user')

@section('title')
    {{ $product->title }}
@endsection

@push('seo')
    {{-- Facebook Meta Tag --}}
    <meta property="og:site_name" content="JDIH Bone Bolango">
    <meta property="og:title" content="{{ $product->title }}" />
    <meta property="og:description" content="{{ $product->title }}" />
    <meta property="og:image" itemprop="image" content="{{ asset('storage/upload/kategori/' . $product->category->icon) }}">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ route('detail-produk', $product->slug) }}" />
@endpush

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="overlay produk d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Produk Hukum</h1>
            <h6 class="subtitle">JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kabupaten Bone Bolango merupakan
                sistem
                pendokumentasian
                Produk Hukum yang ada pada lingkungan Pemerintah Kabupaten Bone Bolango</h6>
            <div class="container box d-lg-block d-none"></div>
        </div>
    </div>

    <!-- Section Detail Product -->
    <section class="detail-product">
        <div class="container">
            <div class="heading">
                <a href="#" class="category-product">{{ $product->category->title }}</a>
                <a href="#" class="status-product">
                    {{ $product->status() }}
                </a>
            </div>
            <h4>{{ $product->title }}</h4>

            <div class="content">
                <div class="row">
                    <div class="col-lg-6">
                        <iframe src="{{ asset('ViewerJS/#../storage/upload/produk/' . $product->file) }}" allowfullscreen
                            webkitallowfullscreen></iframe>
                        <a href="{{ route('unduh-produk', $product->slug) }}" class="download-button">Unduh
                            <span><img src="{{ asset('template_user/assets/img/icon/download.svg') }}"
                                    alt="icon download"></span>
                        </a>
                        <p class="text-center" style="color: #000D4B;">Atau</p>
                        <div class="info">
                            <div class="social-media text-center">
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
                    </div>
                    <div class="col-lg-6">
                        <table class="table">
                            <thead style="display: none;">
                                <tr class="row">
                                    <th>META
                                    </th>
                                    <th>
                                        KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row">
                                    <td class="first-col col-md-4">Judul</td>
                                    <td class="col-md-8">{{ $product->title }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">T.E.U</td>
                                    <td class="col-md-8">Indonesia. Bagian Hukum</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Nomor Peraturan</td>
                                    <td class="col-md-8">{{ $product->rule_number }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Tahun Peraturan</td>
                                    <td class="col-md-8">{{ $product->year }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Jenis/Bentuk Peraturan</td>
                                    <td class="col-md-8">{{ $product->category->title }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Singkatan Bentuk Peraturan</td>
                                    <td class="col-md-8">{{ $product->category->short_title }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Tempat Penetapan</td>
                                    <td class="col-md-8">Suwawa</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Tanggal Penetapan</td>
                                    <td class="col-md-8">{{ $product->determination_date }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Lokasi</td>
                                    <td class="col-md-8">Suwawa</td>
                                </tr>

                                <tr class="row">
                                    <td class="first-col col-md-4">Bidang Hukum</td>
                                    <td class="col-md-8">Hukum Umum</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4 ">Bahasa</td>
                                    <td class="col-md-8">Indonesia</td>
                                </tr>
                                <tr class="row">
                                    <td class="first-col col-md-4">Status</td>
                                    <td class="col-md-8 good">
                                        <strong>
                                            {{ $product->status() }}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <hr>
        </div>
    </section>
    <!-- End Section Detail Product-->
@endsection
