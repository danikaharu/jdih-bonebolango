@foreach ($comments as $comment)
    <div class="display-comment">
        <div class="flex flex-column">
            <h4>{{ $comment->comment }}</h4>
        </div>

        @include('admin.discussion.include.replies', ['comments' => $comment->replies])
    </div>
@endforeach
