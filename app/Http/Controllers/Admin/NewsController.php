<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\{StoreNewsRequest, UpdateNewsRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Models\News;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $news = News::latest()->get();
            return DataTables::of($news)
                ->addIndexColumn()
                ->addColumn('body', function ($row) {
                    return  Str::limit(strip_tags($row->body), 30);
                })
                ->addColumn('action', 'admin.news.include.action')
                ->toJson();
        }

        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $attr = $request->validated();

        $dom = new \DOMDocument();
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // preg_match('/data:image\/(?.*?)\;/',$src,$groups);
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid();
                $filepath = ("storage/upload/berita/summernote/$filename.$mimetype");

                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        $attr['body'] = $dom->saveHTML();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = storage_path('app/public/upload/berita/');
            $filename = $request->file('thumbnail')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('thumbnail')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            $attr['thumbnail'] = $filename;
        }

        News::create($attr);

        return redirect()->route('admin.news.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $attr = $request->validated();

        $dom = new \DOMDocument();
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // preg_match('/data:image\/(?.*?)\;/',$src,$groups);
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid();
                $path = ("storage/upload/berita/summernote/");
                $filepath = ("$path.$filename.$mimetype");

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        $attr['body'] = $dom->saveHTML();

        if ($request->file('thumbnail') && $request->file('thumbnail')->isValid()) {

            $path = storage_path('app/public/upload/berita/');
            $filename = $request->file('thumbnail')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('thumbnail')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            // delete old thumbnail from storage
            if ($news->thumbnail != null && file_exists($path . $news->thumbnail)) {
                unlink($path . $news->thumbnail);
            }

            $attr['thumbnail'] = $filename;
        }

        $news->update($attr);

        return redirect()->route('admin.news.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            // determine path thumbnail
            $path = storage_path('app/public/upload/berita/');

            // if thumbnail exist remove file from directory
            if ($news->thumbnail != null && file_exists($path . $news->thumbnail)) {
                unlink($path . $news->thumbnail);
            }

            // summernote 
            $dom = new \DOMDocument();
            $dom->loadHTML($news->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                // if summernote image exist remove file from directory
                if ($src) {
                    $len = strlen("http://127.0.0.1:8000/storage/upload/berita/summernote/");
                    $fileName = substr($src, $len, strlen($src) - $len);
                    unlink(public_path('storage/upload/berita/summernote/' . $fileName));
                }
            }

            $news->delete();
            return redirect()->route('admin.news.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.news.index')
                ->with('error', __('Maaf, Berita tidak bisa dihapus.'));
        }
    }
}
