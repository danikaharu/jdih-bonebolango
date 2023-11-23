@extends('layouts.admin')

@section('title')
    Detail Diskusi
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('template_admin/assets/vendor/css/pages/page-chat.css') }}">
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Diskusi
        </h4>

        <div class="app-chat overflow-hidden card">
            <div class="row g-0">
                <!-- Chat & Contacts -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                    <div class="sidebar-body ps ps--active-y">

                        <!-- Chats -->
                        <ul class="list-unstyled chat-contact-list pt-1" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title">
                                <h5 class="text-primary mb-0">{{ $discussion->subject }}</h5>
                            </li>
                            <li class="chat-contact-list-item">
                                Waktu :
                            </li>
                            <li class="chat-contact-list-item">
                                {{ $discussion->created_at }}
                            </li>
                            <li class="chat-contact-list-item">
                                Pertanyaan :
                            </li>
                            <li class="chat-contact-list-item">
                                {{ $discussion->comment }}
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-header border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2"
                                        data-bs-toggle="sidebar" data-overlay="" data-target="#app-chat-contacts"></i>
                                    <div class="flex-shrink-0 avatar">
                                        <img src="https://ui-avatars.com/api/?name={{ $discussion->name }}" alt="Avatar"
                                            class="rounded-circle" data-bs-toggle="sidebar" data-overlay=""
                                            data-target="#app-chat-sidebar-right">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="m-0">{{ $discussion->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('admin.discussion.include.replies', [
                            'comments' => $discussion->comments,
                        ])
                        <!-- Chat message form -->
                        <div class="chat-history-footer">
                            <form action="{{ route('admin.comment.store') }}" method="POST"
                                class=" d-flex justify-content-between align-items-center ">
                                @csrf
                                <input type="hidden" name="discussion_id" value="{{ $discussion->id }}" />
                                <input type="text"
                                    class="form-control @error('comment') is-invalid @enderror message-input border-0 me-3 shadow-none"
                                    placeholder="Tinggalkan komentar" name="comment">
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="message-actions d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary d-flex send-msg-btn">
                                        <i class="bx bx-paper-plane me-md-1 me-0"></i>
                                        <span class="align-middle d-md-inline-block d-none">Kirim</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Chat History -->
                <div class="app-overlay"></div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("#replyCommentForm").submit(function(e) {
            e.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_id: $("#comment_id").val(),
                    email: $("#email").val(),
                    comment: $("#comment").val(),
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
                        setInterval(location.reload(true), 3000);
                    }
                }
            })
        })
    </script>
    <script src="{{ asset('template_admin/assets/js/chat.js') }}"></script>
@endpush
