@extends('layouts.user')

@section('title')
    {{ $discussion->subject }}
@endsection

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="overlay forum d-flex justify-content-center align-items-center">
        <div class="container text-white text-center">
            <h1 class="title">Forum</h1>
        </div>
        <div class="container box d-lg-block d-none"></div>
    </div>

    <!-- Section Detail Forum -->
    <section class="detail-forum">
        <div class="container">
            <div class="forum-chat">
                <small>
                    <i class='calendar bx-pull-left bx bx-calendar-event'>{{ $discussion->created_at }}</i>
                </small>
                <h5>
                    {{ $discussion->subject }}
                </h5>
                <p>
                    {{ $discussion->comment }}
                </p>
                <div class="info">
                    <small><i class='user bx bx-user'>{{ $discussion->name }}</i>
                    </small>
                    <small><i class='show bx bx-show'>1.110</i>
                    </small>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Forum-->

    <div class="container forum-response mt-3">
        <h5>
            Diskusi
        </h5>
        @include('user.forum.include.replies', [
            'comments' => $discussion->comments,
            'discussion_slug' => $discussion->slug,
        ])
    </div>
@endsection

@push('scripts')
    <script>
        $("#replyCommentForm").submit(function(e) {
            e.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                data: {
                    comment_id: $("#comment_id").val(),
                    email: $("#email").val(),
                    comment: $("#comment").val(),
                },
                success: function(result) {
                    if (result.errors) {
                        $('#res').html('');
                        $('#res').show();
                        $('#res').append('<p>' + result.errors + '</p>');
                    } else {
                        $('.alert-danger').hide();
                        setInterval(location.reload(true), 3000);
                    }
                }
            })
        })
    </script>
@endpush
