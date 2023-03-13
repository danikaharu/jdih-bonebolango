@extends('layouts.user')

@section('title')
    Beranda
@endsection

@section('content')
    <div class="overlay home d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Selamat Datang di JDIH Kabupaten Bone Bolango </h1>
            <h6 class="subtitle">JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kabupaten Bone Bolango merupakan
                sistem
                pendokumentasian
                Produk Hukum yang ada pada lingkungan Pemerintah Kabupaten Bone Bolango</h6>
            <div class="search">
                <input id="search-bar" type="text" name="search" placeholder="Cari Peraturan Disini" class="search__bar">
                <ul id="results">
                </ul>
            </div>
        </div>
    </div>

    <section class="container product">
        <div class="row">
            @foreach ($data['products'] as $product)
                <div class="col-lg-4">
                    <div class="product-box">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset('template_user/assets/img/icon/product-icon.png') }}" alt="">
                            </div>
                            <div class="col-lg-8">
                                <a href="{{ route('detail-produk', $product->slug) }}" class="product-title">
                                    {{ $product->category->description }} Nomor {{ $product->rule_number }}
                                    Tahun {{ $product->year }}
                                    Tentang {{ $product->title }}
                                </a>
                                <a href="#" class="product-category">{{ $product->category->title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="news">
        <div class="container">
            <div class="heading" data-aos="fade-right" data-aos-duration="1000">
                <h3>Berita Terkini</h3>
                <div class="arrow">
                    <a class="arrow-left mr-4" href="#newsCarousel" role="button" data-bs-slide="prev">
                        <img src="{{ asset('template_user/assets/img/icon/arrow-left.svg') }} " alt="arrow left">
                    </a>
                    <a class="arrow-right " href="#newsCarousel" role="button" data-bs-slide="next">
                        <img src="{{ asset('template_user/assets/img/icon/arrow-right.svg') }}" alt="arrow right">
                    </a>
                </div>
            </div>

            <div class="row">

                <div class="col-12" data-aos="fade-up" data-aos-duration="2000">
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($data['news']->chunk(3) as $newsCollection)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($newsCollection as $news)
                                            <div
                                                class="col-lg-4 mb-3 {{ $loop->iteration == 2 || $loop->iteration == 3 ? 'clearfix d-none d-lg-block' : '' }}">
                                                <div class="news-content">
                                                    <div class="card">
                                                        <a href="{{ route('detail-berita', $news->slug) }}">
                                                            <img src="{{ asset('storage/upload/berita/' . $news->thumbnail) }}"
                                                                alt="gambar berita">
                                                            <p>{{ $news->title }}</p>
                                                        </a>
                                                        <small><i class='bx-pull-left bx bx-calendar-event bx-sm'></i>
                                                            {{ $news->created_at }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="catalog">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1500">
                    <div class="catalog-heading">
                        <h3>Katalog Produk Hukum
                            Daerah</h3>
                        <p>Berisi peraturan-peraturan yang ada di Kabupaten Bone Bolango yang meliputi, Peraturan Daerah,
                            Peraturan Bupati, Surat Keputusan Bupati, dan Surat Keputusan Sekretaris Daerah</p>
                        <a href="#">Pelajari Lebih Lanjut <i class='bx bx-right-arrow-alt'></i> </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="catalog-card">
                                <div class="catalog-card-heading">
                                    <img src="{{ asset('template_user/assets/img/icon/perda.png') }}" alt="icon">
                                    <h5>Peraturan Daerah
                                        (PERDA)</h5>
                                </div>
                                <p>Peraturan Perundang-undangan yang dibentuk oleh Dewan Perwakilan Rakyat Daerah Kabupaten
                                    dengan persetujuan bersama Bupati.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="catalog-card">
                                <div class="catalog-card-heading">
                                    <img src="{{ asset('template_user/assets/img/icon/perbup.png') }}" alt="icon">
                                    <h5>Peraturan Bupati
                                        (PERBUP)</h5>
                                </div>
                                <p>Peraturan perundang-undangan daerah yang ditetapkan oleh Bupati</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="catalog-card">
                                <div class="catalog-card-heading">
                                    <img src="{{ asset('template_user/assets/img/icon/kepbup.png') }}">
                                    <h5>Surat Keputusan Bupati
                                        (SK Bupati)</h5>
                                </div>
                                <p>Naskah dinas dalam bentuk Keputusan yang bersifat penetapan dan ditandatangani oleh
                                    Bupati</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="catalog-card">
                                <div class="catalog-card-heading">
                                    <img src="{{ asset('template_user/assets/img/icon/kepsek.png') }}">
                                    <h5>Surat Keputusan Sekda
                                        (SK Sekda)</h5>
                                </div>
                                <p>Naskah dinas dalam bentuk Keputusan yang bersifat penetapan dan ditandatangani oleh
                                    Sekretaris Daerah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="welcome">
        <div class="container">
            <div class="welcome-box">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="vector1 d-none d-lg-block">
                            <img src="{{ asset('template_user/assets/img/vector/vector1.svg') }} " alt="vector">
                        </div>
                        <div class="welcome-image">
                            <img src="{{ asset('template_user/assets/img/bupati.webp') }} " alt="welcome-image">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="vector2 d-none d-lg-block">
                            <img src="{{ asset('template_user/assets/img/vector/vector2.svg') }} " alt="vector">
                        </div>
                        <div class="welcome-text">
                            <h2>Selamat Datang di Website
                                JDIH Kabupaten Bone Bolango</h2>
                            <p>Jaringan Dokumentasi dan Informasi Hukum adalah suatu wadah pendayagunaan bersama
                                atas
                                dokumen hukum secara tertib, terpadu dan berkesinambungan serta merupakan sarana
                                pemberian pelayanan informasi hukum secara lengkap, akurat, mudah, dan cepat.
                            </p>
                            <p>
                                Semoga dengan adanya website ini, diharapkan mampu meningkatkan efektifitas
                                penyebarluasan produk hukum khususnya Produk Hukum Daerah Kabupaten Bone Bolango yang
                                meliputi
                                Peraturan Daerah (PERDA), Peraturan Bupati (PERBUP), dan Keputusan Bupati (KEPBUP)
                                sehingga kedepannya mampu menciptakan masyarakat Bone Bolango yang sadar hukum. Amin.
                            </p>
                            <a href="{{ route('profil') }}">Profil Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="statistic">
        <div class="container">
            <h3>Statistik Produk Hukum Daerah</h3>
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="statistic-card">
                        <h4>{{ $data['totalProduct'] }}</h4>
                        <h5>Total Produk
                            Hukum Daerah</h5>
                        <p>Kumpulan Produk Hukum yang meliputi Peraturan Daerah, Peraturan Bupati, dan Keputusan
                            Bupati
                        </p>
                        <a href="#">Lihat Selengkapnya <i class='bx bx-right-arrow-alt bx-sm'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="statistic-card">
                        <h4>{{ $data['totalCategoryProduct'][0]->products_count }}</h4>
                        <h5>Peraturan Daerah</h5>
                        <p>Peraturan Perundang-undangan yang dibentuk oleh Dewan Perwakilan Rakyat Daerah Kabupaten dengan
                            persetujuan bersama Bupati.</p>
                        <a href="#">Lihat Selengkapnya <i class='bx bx-right-arrow-alt bx-sm'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="statistic-card">
                        <h4>{{ $data['totalCategoryProduct'][1]->products_count }}</h4>
                        <h5>Peraturan Bupati</h5>
                        <p>Peraturan perundang-undangan daerah yang ditetapkan oleh Bupati</p>
                        <a href="#">Lihat Selengkapnya <i class='bx bx-right-arrow-alt bx-sm'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="statistic-card">
                        <h4>{{ $data['totalCategoryProduct'][2]->products_count }}</h4>
                        <h5>Keputusan Bupati</h5>
                        <p>Naskah dinas dalam bentuk Keputusan yang bersifat penetapan dan ditandatangani oleh Bupati</p>
                        <a href="#">Lihat Selengkapnya <i class='bx bx-right-arrow-alt bx-sm'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery">
        <div class="container">
            <div class="heading" data-aos="fade-right" data-aos-duration="1000">
                <h3>Galeri Terbaru</h3>
                <div class="arrow">
                    <a class="arrow-left mr-4" href="#galleryCarousel" role="button" data-bs-slide="prev">
                        <img src="{{ asset('template_user/assets/img/icon/arrow-left.svg') }}" alt="arrow left">
                    </a>
                    <a class="arrow-right " href="#galleryCarousel" role="button" data-bs-slide="next">
                        <img src="{{ asset('template_user/assets/img/icon/arrow-right.svg') }}" alt="arrow right">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-duration="2000">
                    <div id="galleryCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($data['galleries']->chunk(4) as $galleryCollection)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($galleryCollection as $gallery)
                                            <div
                                                class="col-lg-3 mb-3 {{ $loop->iteration == 2 || $loop->iteration == 3 ? 'clearfix d-none d-lg-block' : '' }}">
                                                <div class="gallery-content">
                                                    <div class="card">
                                                        <a href="{{ route('detail-galeri', $gallery->slug) }}">
                                                            <img src="{{ asset('storage/upload/galeri/' . $gallery->thumbnail()->file) }}"
                                                                alt="galeri">
                                                            <p>{{ $gallery->title }}</p>
                                                        </a>
                                                        <small><i class='bx-pull-left bx bx-show bx-sm'></i>
                                                            1.110</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="consultation">
        <div class="container">
            <div class="consultation-heading" data-aos="fade-down" data-aos-duration="1500">
                <h3>Konsultasi Hukum</h3>
            </div>
            <div class="vector3 d-none d-lg-block">
                <img src="{{ asset('template_user/assets/img/vector/vector3.svg') }}" alt="vector">
            </div>
            <div class="consultation-content" data-aos="fade-right" data-aos-duration="2000">
                <div class="row">
                    <div class="col-lg-6">
                        <form id="discussionForm" action="{{ route('forum.store') }}" method="POST" class="row g-3">
                            @csrf
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="alert alert-success" style="display:none"></div>
                            <div class="col-md-12">
                                <input type="text" id="name" class="form-control" placeholder="Nama"
                                    name="name">
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="email" class="form-control" placeholder="Email"
                                    name="email">
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="subject" class="form-control " placeholder="Subjek"
                                    name="subject">
                            </div>
                            <div class="col-md-12">
                                <textarea name="comment" id="comment" class="form-control " rows="8" placeholder="Pertanyaan"></textarea>
                            </div>
                            <div class="col-12">
                                <button id="btnDiscussion" class="btn btn-submit" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="vector4 d-none d-lg-block">
                            <img src="{{ asset('template_user/assets/img/vector/vector4.svg') }}" alt="vector">
                        </div>
                        <div id="consultation-carousel" class="carousel slide" data-bs-interval="false">
                            <div class="carousel-inner text-center">
                                @foreach ($data['discussions'] as $discussion)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <p><img src="{{ asset('template_user/assets/img/icon/double-quote.svg') }}"
                                                alt="double quote">
                                            {{ $discussion->comment }}
                                        </p>
                                        <h6>{{ $discussion->name }}</h6>
                                        <a href="{{ route('detail-forum', $discussion->slug) }}">Selengkapnya</a>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#consultation-carousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#consultation-carousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <a class="consultation-link" href="#">Forum Tanya Jawab <i
                                class='bx bx-right-arrow-alt bx-sm'></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="polling">
        <div class="container">
            <div class="polling-heading" data-aos="fade-down" data-aos-duration="1500">
                <h3>Poling Kepuasan Web JDIH</h3>
                <h6>Bagaimana Kualitas Layanan Web JDIH dari Rentang Bintang
                    1 (Sangat Buruk) sampai 5 (Sangat Baik) ?</h6>
            </div>
            <div class="polling-content" data-aos="fade-right" data-aos-duration="1500">
                <div class="row">
                    <div class="col-lg-6">
                        <form id="pollingForm" action="{{ route('survey.store') }}" method="POST" class="row g-3">
                            @csrf
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <div id="response"></div>
                            <div class="col-md-12">
                                <input type="text" id="nameParticipant" class="form-control " placeholder="Nama"
                                    name="name">
                            </div>
                            <div class="col-md-12">
                                <input type="email" id="emailParticipant" class="form-control" placeholder="Email"
                                    name="email">
                            </div>
                            <div class="col-md-12">
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="rating"
                                        value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" checked id="star4" class="rate" name="rating"
                                        value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating"
                                        value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2">
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating"
                                        value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea id="commentParticipant" class="form-control" rows="3" placeholder="Kritik & Saran"></textarea>
                            </div>
                            <div class="col-12">
                                <button id="btnPolling" class="btn-custom" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="polling-progress">
                            <h2>{{ $data['averageRating'] }}</h2>
                            @include('user.home.include.rating')
                            <h6>{{ $data['totalSurvey'] }} penilaian</h6>
                            <div class="table-responsive text-start">
                                <table class="table table-borderless text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="d-none">Rating</th>
                                            <th class="d-none">Persentase Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-white">5</td>
                                            <td class="w-100">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        aria-label="Basic example"
                                                        style="width: {{ $data['percent5Rating'] }}%"
                                                        aria-valuenow="{{ $data['percent5Rating'] }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-white">4</td>
                                            <td class="w-100">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        aria-label="Basic example"
                                                        style="width: {{ $data['percent4Rating'] }}%"
                                                        aria-valuenow="{{ $data['percent4Rating'] }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-white">3</td>
                                            <td class="w-100">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        aria-label="Basic example"
                                                        style="width: {{ $data['percent3Rating'] }}%"
                                                        aria-valuenow="{{ $data['percent3Rating'] }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-white">2</td>
                                            <td class="w-100">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        aria-label="Basic example"
                                                        style="width: {{ $data['percent2Rating'] }}%"
                                                        aria-valuenow="{{ $data['percent2Rating'] }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-white">1</td>
                                            <td class="w-100">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        aria-label="Basic example"
                                                        style="width: {{ $data['percent1Rating'] }}%"
                                                        aria-valuenow="{{ $data['percent1Rating'] }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
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
        </div>
    </section>

    <section class="related-link">
        <h2>Tautan Terkait</h2>
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6">
                    <a href="https://kominfo.bonebolangokab.go.id" target="_blank">
                        <img class="img-fluid" src="{{ asset('template_user/assets/img/logo/kominfo.webp') }}"
                            alt="logo">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="https://bonebolangokab.go.id" target="_blank">
                        <img class="img-fluid" src="{{ asset('template_user/assets/img/logo/pemkab.webp') }}"
                            alt="logo">
                    </a>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-6">
                    <a href="https://opendata.bonebolangokab.go.id" target="_blank">
                        <img class="img-fluid" src="{{ asset('template_user/assets/img/logo/open_data.webp') }}"
                            alt="logo">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="https://ppid.bonebolangokab.go.id" target="_blank">
                        <img class="img-fluid" src="{{ asset('template_user/assets/img/logo/ppid.webp') }}"
                            alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Polling Form
            $("#pollingForm").submit(function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                $.post(url, {
                        '_token': $("#token").val(),
                        name: $("#nameParticipant").val(),
                        email: $("#emailParticipant").val(),
                        rating: $("input:checked").val(),
                        comment: $("#commentParticipant").val()
                    },
                    function(response) {
                        if (response.code == 400) {
                            $("#btnPolling").attr('disabled', false);
                            let error = '<span class="alert alert-danger">' + response.msg + '</span>';
                            $("#response").html(error);
                        } else if (response.code == 200) {
                            $("#btnPolling").attr('disabled', false);
                            let success = '<span class="alert alert-success">' + response.msg +
                                '</span>';
                            $("#response").html(success);
                            $("#pollingForm")[0].reset();
                            window.setTimeout(function() {
                                location.reload()
                            }, 1000);
                        }
                    });
            })

            // Discussion Form
            $("#discussionForm").submit(function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    data: {
                        name: $("#name").val(),
                        email: $("#email").val(),
                        subject: $("#subject").val(),
                        comment: $("#comment").val()
                    },
                    success: function(result) {
                        if (result.errors) {
                            $('.alert-danger').html('');

                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + value + '</li>');
                            });
                        } else {
                            $('.alert-danger').hide();
                            $('.alert-success').html('');
                            $('.alert-success').show();
                            $('.alert-success').append(result.success);
                            $("#name").val('');
                            $("#email").val('');
                            $("#subject").val('');
                            $("#comment").val('');
                            setInterval(location.reload(true), 20000);
                        }
                    }
                })
            })
        })
    </script>

    <script>
        const resultsList = document.getElementById('results');

        function createLi(searchResult) {
            const li = document.createElement('li');
            const link = document.createElement('a');
            link.href = searchResult.view_link;
            link.textContent = searchResult.match;
            const h4 = document.createElement('h4')
            h4.appendChild(link);
            li.appendChild(h4);
            return li;
        }

        document.getElementById('search-bar').addEventListener('input', function(event) {
            event.preventDefault();

            const searched = event.target.value;

            fetch('/api/searchProduct?search=' + searched, {
                method: 'GET'
            }).then((response) => {
                return response.json();
            }).then((response) => {
                const results = response;

                // empty list
                resultsList.innerHTML = '';
                results.forEach((result) => {
                    resultsList.appendChild(createLi(result))
                })
            })
        })
    </script>
@endpush
