@foreach ($comments as $comment)
    <div class="display-comment">
        <div class="flex flex-column">
            <div class="row">
                <div class="col-lg-2">
                    <h6>
                        @if ($comment->parent_id == null)
                            Admin
                        @else
                            {{ $discussion->name }}
                        @endif
                    </h6>

                </div>
                <div class="col-lg-10">
                    <p>
                        @if ($comment->parent_id == null)
                            {{ $comment->comment }}
                        @else
                            {{ $comment->comment }}
                        @endif
                    </p>
                </div>
            </div>
            <hr>
        </div>


        @include('user.forum.include.replies', ['comments' => $comment->replies])

        @if ($comment->parent_id == null)
            <!-- Button Reply Comment modal -->
            <button id="btnCommentModal" type="button" class="btn my-2" data-bs-toggle="modal"
                data-bs-target="#replyCommentModal"
                style="background: linear-gradient(227.94deg, #09229A 11.22%, #000D4B 65.37%);
                border-radius: 6px; color:white;padding:10px 30px;">
                Balas
            </button>

            <!-- Modal -->
            <div class="modal fade" id="replyCommentModal" tabindex="-1" aria-labelledby="replyCommentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="m-0">Komentar Balasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="alert alert-danger" style="display:none"></div>
                        <div class="modal-body">
                            <form id="replyCommentForm"
                                action="{{ route('forum.storeReplyComment', $discussion->slug) }}" method="POST">
                                <div id="res" class="alert alert-danger" style="display: none;"></div>
                                <input type="hidden" id="comment_id" name="comment_id" value="{{ $comment->id }}" />
                                <div class="form-group my-2">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" name="email"
                                        placeholder="Konfirmasi Email Anda" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="comment">Balasan</label>
                                    <textarea id="comment" name="comment" class="form-control " placeholder="Masukkan komentar anda disini"></textarea>
                                </div>
                                <button id="btnReply" type="submit"
                                    class="btn btn-outline-primary my-2">Balas</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endforeach
