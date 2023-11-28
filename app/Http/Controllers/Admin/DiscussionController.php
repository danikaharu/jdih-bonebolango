<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discussion\StoreDiscussionRequest;
use App\Models\Comment;
use App\Models\Discussion;
use Yajra\DataTables\Facades\DataTables;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $discussions = Discussion::latest()->get();
            return DataTables::of($discussions)
                ->addIndexColumn()
                ->addColumn('action', 'admin.discussion.include.action')
                ->toJson();
        }

        return view('admin.discussion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discussion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionRequest $request)
    {
        $attr = $request->validated();

        Discussion::create($attr);

        return redirect()->route('admin.discussion.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('admin.discussion.show', compact('discussion'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        try {
            $comment = Comment::where('commentable_id', $discussion->id);
            if ($comment) {
                $comment->delete();
                $discussion->delete();
            } else {
                $discussion->delete();
            }

            return redirect()
                ->route('admin.discussion.index')
                ->with('success', __('Data Berhasil Dihapus'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.discussion.index')
                ->with('error', __('Maaf, tidak bisa hapus diskusi'));
        }
    }
}
