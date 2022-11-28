@extends('layouts.user')

@section('title')
    Produk Hukum
@endsection

@section('content')
    <div class="overlay forum d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Produk Hukum</h1>
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

    <!-- Section Product Page -->
    <section class="product-page">
        <div class="container">
            <div class="heading">
                <h3>Semua Peraturan</h3>
                {{-- <button type="button" class="btn btn-product" data-bs-toggle="modal" data-bs-target="#requestProductModal">
                    Permintaan Peraturan
                </button> --}}

                <!-- Modal -->
                {{-- <div class="modal fade" id="requestProductModal" tabindex="-1" aria-labelledby="forumModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="forumModalLabel">Permohonan Peraturan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="requestProductForm" action="{{ route('request-product.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="token" value="{{ csrf_token() }}">
                                    <div id="res"></div>
                                    <div class="mb-2">
                                        <label for="name" class="form-label">Nama</label>
                                        <input id="name" name="name" type="text" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" name="email" type="email" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="job" class="form-label">Pekerjaan</label>
                                        <select id="job" name="job" class="form-select">
                                            <option selected disabled>-- Pilih Pekerjaan --</option>
                                            <option value="1">Pelajar/Mahasiswa/Akademisi</option>
                                            <option value="2">Profesional</option>
                                            <option value="3">Wirausaha</option>
                                            <option value="4">Pemerintahan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="request_title" class="form-label">Judul Peraturan Yang
                                            Diminta</label>
                                        <input id="request_title" name="request_title" type="text" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="request_purpose" class="form-label">Tujuan Permohonan</label>
                                        <select id="request_purpose" name="request_purpose" class="form-select">
                                            <option selected disabled>-- Pilih Tujuan Permohonan --</option>
                                            <option value="1">
                                                Referensi Kajian Bisnis</option>
                                            <option value="2">
                                                Referensi Pembuatan Kebijakan</option>
                                            <option value="3">
                                                Referensi Pembuatan Kurikulum</option>
                                            <option value="4">
                                                Referensi Tugas/Karya Ilmiah</option>
                                            <option value="5">
                                                Referensi Pribadi</option>
                                        </select>
                                    </div>
                                    <button id="btnRequestProduct" type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="content">
                <div class="col-12">
                    @foreach ($products as $product)
                        <div class="card">
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-none d-md-block">
                                        <img src="{{ asset('storage/upload/kategori/' . $product->category->icon) }}"
                                            alt="product-icon" class="category-icon">

                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="head">
                                        <a href="#" class="category-product">{{ $product->category->title }}</a>
                                        <a href="#" class="status-product">
                                            @if ($product->status == 1)
                                                Mengubah
                                            @elseif($product->status == 2)
                                                Diubah
                                            @elseif($product->status == 3)
                                                Mencabut
                                            @else
                                                Dicabut
                                            @endif
                                        </a>
                                    </div>
                                    <div class="body">
                                        <a href="{{ route('detail-produk', $product->slug) }}">
                                            <h4>{{ $product->category->description }} Nomor {{ $product->rule_number }}
                                                Tahun {{ $product->year }}
                                                Tentang {{ $product->title }}</h4>
                                        </a>
                                        <hr style="color: #D9D9D9;">
                                    </div>
                                    <div class="foot">
                                        <a href="{{ route('unduh-produk', $product->slug) }}">Unduh
                                            <span><img src="{{ asset('template_user/assets/img/icon/download.svg') }}"
                                                    alt="icon download"></span>
                                        </a>
                                        <small>
                                            <i class='show bx bx-show'>1.110</i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{ $products->links('vendor.pagination.custom') }}
    </section>
    <!-- End Section Product-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Request Product Form
            $("#requestProductForm").submit(function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                $("#btnRequestProduct").attr('disabled', true);
                $.post(url, {
                        '_token': $("#token").val(),
                        name: $("#name").val(),
                        email: $("#email").val(),
                        job: $("#job").val(),
                        request_title: $("#request_title").val(),
                        request_purpose: $("#request_purpose").val()
                    },
                    function(response) {
                        if (response.code == 400) {
                            $("#btnRequestProduct").attr('disabled', false);
                            let error = '<span class="text-danger">' + response.msg +
                                '</span>';
                            $("#res").html(error);
                        } else if (response.code == 200) {
                            $("#btnRequestProduct").attr('disabled', false);
                            let success = '<span class="text-success">' + response.msg +
                                '</span>';
                            $("#res").html(success);
                            $("#requestProductForm")[0].reset();
                        }
                    });
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
            const span = document.createElement('span');
            //  span.textContent = searchResult.match;
            li.appendChild(h4);
            //  li.appendChild(span);
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
