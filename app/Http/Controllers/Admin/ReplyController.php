<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    public function replyDiscussion($id)
    {
        $discussion = Discussion::findOrFail($id);

        return view('admin.discussion.reply', compact('discussion'));
    }

    public function storeReplyDiscussion(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required'
        ]);

        try {
            DB::beginTransaction();

            Reply::updateOrCreate(
                [
                    'discussion_id' => $id,
                ],
                [
                    'comment' => $validated['comment']
                ]
            );

            $discussion = Discussion::find($id);
            $discussion->is_approved = 1;
            $discussion->save();

            DB::commit();
            return redirect()->route('admin.discussion.index')->with('success', __('Diskusi Telah Dijawab'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.discussion.index')
                ->with('error', __('Maaf, tidak bisa simpan data.'));
        }
    }
}
