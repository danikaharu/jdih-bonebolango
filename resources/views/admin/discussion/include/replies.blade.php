<div class="chat-history-body ps ps--active-y">
    <ul class="list-unstyled chat-history mb-0">
        @foreach ($comments as $comment)
            <li class="chat-message @if ($comment->parent_id == null) chat-message-right @endif ">
                <div class="d-flex overflow-hidden">
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                            <p class="mb-0"> {{ $comment->comment }}</p>
                        </div>
                        <div class="text-end text-muted mt-1">
                            <i class="bx bx-check-double text-success"></i>
                            <small>{{ $comment->created_at }}</small>
                        </div>
                    </div>
                    <div class="user-avatar flex-shrink-0 ms-3">
                        <div class="avatar avatar-sm">
                            @if ($comment->parent_id == null)
                                <img src="{{ asset('template_admin/assets/img/avatars/1.png') }}" alt="Avatar"
                                    class="rounded-circle">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $discussion->name }}" alt="Avatar"
                                    class="rounded-circle">
                            @endif

                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: -62px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 62px; height: 382px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 21px; height: 130px;"></div>
    </div>
</div>
