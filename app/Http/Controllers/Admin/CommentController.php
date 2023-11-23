<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Discussion;
use App\Notifications\ReplyDiscussionNotification;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;

        $comment->comment = $request->comment;

        $discussion = Discussion::find($request->discussion_id);
        $discussion->is_approved = 1;
        $discussion->save();

        $discussion->comments()->save($comment);

        $this->sendEmail($discussion);

        return redirect()->back()->with('success', 'Komentar berhasil');
    }

    public function storeReplyComment(Request $request, Discussion $discussion)
    {
        if ($request->ajax()) {

            $validation = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                ],
                'comment' => ['required', 'string'],
            ], [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Diisi dengan email yang valid',
                'comment.required' => 'Komentar wajib diisi',
            ]);

            if ($validation->fails()) {
                return response()->json(['errors' => $validation->errors()->all()]);
            }

            if ($discussion->email == $request->get('email')) {
                $reply = new Comment();
                $reply->comment = $request->get('comment');
                $reply->parent_id = $request->get('comment_id');
                $discussion->comments()->save($reply);

                return response()->json(['success' => 'Komentar berhasil dibalas']);
            } else {
                return response()->json(['errors' => 'Maaf email tersebut tidak ada']);
            }
        }
    }

    private function sendEmail(Discussion $discussion)
    {
        $comments = [
            'greeting' => 'Halo ' . $discussion->name . ',',
            'actionURL' => route('detail-forum', $discussion->slug)
        ];

        $discussion->notify(new ReplyDiscussionNotification($comments));
    }
}
