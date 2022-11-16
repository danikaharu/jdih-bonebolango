<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|min:3|max:255',
                'subject' => 'required|string|min:3|max:255',
                'comment' => 'required|string',
            ], [
                'name.required' => 'Nama wajib diisi',
                'name.min' => 'Nama minimal 3 kata',
                'name.max' => 'Nama maksimal 255 kata',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Diisi dengan email yang valid',
                'email.min' => 'Email minimal 3 kata',
                'email.max' => 'Email maksimal 255 kata',
                'subject.required' => 'Subjek wajib diisi',
                'subject.min' => 'Subjek minimal 3 kata',
                'subject.max' => 'Subjek maksimal 255 kata',
                'comment.required' => 'Komentar wajib diisi',
            ]);

            if ($validation->fails()) {
                return response()->json(['errors' => $validation->errors()->all()]);
            }

            $discussion = new Discussion();
            $discussion->name = $request->name;
            $discussion->email = $request->email;
            $discussion->subject = $request->subject;
            $discussion->comment = $request->comment;
            $discussion->slug = Str::slug($request->subject);
            $discussion->save();

            return response()->json(['success' => 'Terima kasih telah bertanya, pesan anda akan disampaikan kepada operator']);
        }
    }

    public function storeReplyComment(Request $request, Discussion $discussion)
    {
        if ($request->ajax()) {

            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'comment' => 'required|string',
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
}
