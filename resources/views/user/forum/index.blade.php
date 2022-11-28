@extends('layouts.user')

@section('title')
    Forum
@endsection

@section('content')
    <div class="overlay forum d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Tanya Jawab</h1>
            <h6 class="subtitle">JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kabupaten Bone Bolango merupakan
                sistem
                pendokumentasian
                Produk Hukum yang ada pada lingkungan Pemerintah Kabupaten Bone Bolango</h6>
            <div class="search">
                <input id="search-bar" type="text" name="search" placeholder="Cari Subjek Diskusi Disini"
                    class="search__bar">
                <ul id="results">
                </ul>
            </div>
        </div>
    </div>

    <!-- Section Forum -->
    <section class="forum">
        <div class="container">
            <div class="heading">
                <h3>Semua Pertanyaan</h3>
                <button type="button" class="btn btn-forum" data-bs-toggle="modal" data-bs-target="#forumModal">
                    Ajukan Pertanyaan
                </button>

                <!-- Modal -->
                <div class="modal fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="forumModalLabel">Konsultasi Hukum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="alert alert-success" style="display:none"></div>
                            <div class="modal-body">
                                <form id="discussionForm" action="{{ route('forum.store') }}" method="POST">
                                    <div class="mb-2">
                                        <label for="name" class="form-label">Nama</label>
                                        <input id="name" type="text" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="subject" class="form-label">Subjek</label>
                                        <input id="subject" type="text" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="comment" class="form-label">Pertanyaan</label>
                                        <textarea id="comment" name="pertanyaan" rows="5" class="form-control"></textarea>
                                    </div>
                                    <button id="btnDiscussion" type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                @foreach ($discussions as $discussion)
                    <div class="col-12 mb-3">
                        <div class="card">
                            <small><i class='calendar bx-pull-left bx bx-calendar-event'>{{ $discussion->created_at }}</i>
                            </small>
                            <a href="{{ route('detail-forum', $discussion->slug) }}">
                                {{ $discussion->subject }}
                            </a>
                            <p>{{ $discussion->comment }}</p>
                            <div class="info">
                                <small><i class='user bx bx-user'>{{ $discussion->name }}</i>
                                </small>
                                <small><i class='show bx bx-show'>1.110</i>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{ $discussions->links('vendor.pagination.custom') }}
    </section>
    <!-- End Section Forum-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
            const span = document.createElement('span');
            //  span.textContent = searchResult.match;
            li.appendChild(h4);
            //  li.appendChild(span);
            return li;
        }
        document.getElementById('search-bar').addEventListener('input', function(event) {
            event.preventDefault();

            const searched = event.target.value;
            fetch('/api/searchDiscussion?search=' + searched, {
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
