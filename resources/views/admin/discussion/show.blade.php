@extends('layouts.admin')

@section('title')
    Detail Diskusi
@endsection

@push('style')
    <style>
        .display-comment .display-comment {
            margin-left: 40px
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Diskusi
        </h4>

        <div class="card">
            <h5 class="card-header">{{ $discussion->subject }}</h5>

            <div class="card-body">
                <div class="card-title"> Tampilkan Komentar</div>
                @include('admin.discussion.include.replies', [
                    'comments' => $discussion->comments,
                    'discussion_slug' => $discussion->slug,
                ])

                <hr>
                <div class="card-title"> Tinggalkan Komentar</div>

                <form action="{{ route('admin.comment.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 col-md-12">
                        <input class="form-control  @error('comment') is-invalid @enderror" type="text" name="comment" />
                        <input type="hidden" name="discussion_id" value="{{ $discussion->id }}" />
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Balas Admin</button>
                    </div>
                </form>
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
@endpush
