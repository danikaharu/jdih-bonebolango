@extends('layouts.user')

@section('title')
    Berita
@endsection

@section('content')
    <div class="overlay news d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Berita</h1>
            <h6 class="subtitle">JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kabupaten Bone Bolango merupakan
                sistem
                pendokumentasian
                Produk Hukum yang ada pada lingkungan Pemerintah Kabupaten Bone Bolango</h6>
            <div class="search">
                <input id="search-bar" type="text" name="search" placeholder="Cari Berita Disini" class="search__bar">
                <ul id="results">
                </ul>
            </div>
        </div>
    </div>

    <!-- Section Berita -->
    <section class="berita">
        <div class="container">
            <div class="row">
                @foreach ($news as $data)
                    <div class="col-lg-4 mb-3">
                        <div class="berita-content">
                            <div class="card">
                                <a href="{{ route('detail-berita', $data->slug) }}">
                                    <img src="{{ asset('storage/upload/berita/' . $data->thumbnail) }}" alt="gambar berita">
                                    <small><i class='bx-pull-left bx bx-calendar-event bx-sm'></i>
                                        {{ $data->created_at }}</small>
                                    <p>{{ $data->title }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{ $news->links('vendor.pagination.custom') }}

    </section>
    <!-- End Section Berita-->
@endsection

@push('scripts')
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
            fetch('/api/searchNews?search=' + searched, {
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
