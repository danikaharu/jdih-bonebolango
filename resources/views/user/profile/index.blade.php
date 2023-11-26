@extends('layouts.user')

@section('title')
    Profil
@endsection

@section('content')
    <div class="overlay profil d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Profil</h1>
            <h6 class="subtitle">JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kabupaten Bone Bolango merupakan
                sistem
                pendokumentasian
                Produk Hukum yang ada pada lingkungan Pemerintah Kabupaten Bone Bolango</h6>
            <div class="container box d-lg-block d-none"></div>
        </div>
    </div>

    <!-- Section Profile -->
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <select class="form-select d-block d-md-none mb-3" id="selectProfile">
                        @foreach ($profiles as $profil)
                            <option href="#v-pills-{{ $profil->id }}"> {{ $profil->title }}</option>
                        @endforeach
                    </select>
                    <div class="profile-content">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($profiles as $key => $profil)
                                <div class="tab-pane fade {{ $profil->id == 1 ? 'show active' : '' }}"
                                    id="v-pills-{{ $profil->id }}" role="tabpanel">
                                    <h3 class="profile-title">{{ $profil->title }}</h3>
                                    <p> {!! $profil->body !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sticky-top" style="padding-right: 3rem; padding-left: 1.2rem; top:10rem;">
                        <div class="accordion-menu d-none d-lg-block">
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    @foreach ($profiles as $profil)
                                        <button class="nav-link {{ $profil->id == 1 ? 'active' : '' }}"
                                            id="v-pills-{{ $profil->id }}" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-{{ $profil->id }}" type="button" role="tab"
                                            aria-controls="v-pills-{{ $profil->id }}"
                                            aria-selected="{{ $profil->id == 1 ? 'true' : 'false' }}">{{ $profil->title }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="profile-contact">
                            <ul>
                                <li><img src="{{ asset('template_user/assets/img/icon/telephone-blue.png') }}"
                                        alt="icon">
                                    +62 81-234-567-890</li>
                                <li><img src="{{ asset('template_user/assets/img/icon/email-blue.png') }}" alt="icon">
                                    jdih@bonebolangokab.go.id
                                </li>
                                <li>
                                    <img src="{{ asset('template_user/assets/img/icon/location-blue.png') }}"
                                        alt="icon">
                                    Kompleks Kantor Bupati
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Profile-->
@endsection

@push('scripts')
    <script>
        $('#selectProfile').on('change', function() {
            var selected_id = $(this).find('option:selected').attr('href');
            $('.tab-content .tab-pane').removeClass('show active');
            $(selected_id).addClass('show active');
        });
    </script>
@endpush
