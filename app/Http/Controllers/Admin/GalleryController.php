<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\{StoreGalleryRequest, UpdateGalleryRequest};
use App\Models\{Gallery, Photo};
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $galleries = Gallery::latest()->get();
            return DataTables::of($galleries)
                ->addIndexColumn()
                ->addColumn('description', function ($gallery) {
                    return  Str::limit(stripslashes($gallery->description), 30);
                })
                ->addColumn('created_at', function ($gallery) {
                    return  $gallery->created_at->isoFormat('dddd, D MMMM Y');
                })
                ->addColumn('action', 'admin.gallery.include.action')
                ->toJson();
        }

        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Admin\Gallery\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        $attr = $request->validated();

        // echo '<pre>';
        // var_dump($attr);
        // echo '</pre>';

        try {
            DB::beginTransaction();
            // Create Gallery
            $gallery = new Gallery();
            $gallery->title = $attr['title'];
            $gallery->slug = Str::slug($attr['title']);
            $gallery->description =  $attr['description'];
            $gallery->user_id = Auth::user()->id;
            $gallery->save();

            if ($request->hasFile('file')) {
                $images = $request->file('file');
                foreach ($images as $image) {

                    if ($image->isValid()) {
                        $path = storage_path('app/public/upload/galeri/');
                        $filename = $image->hashName();

                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        Image::make($image->getRealPath())->resize(500, 500, function ($constraint) {
                            $constraint->upsize();
                            $constraint->aspectRatio();
                        })->save($path . $filename);

                        $attr['file'] = $filename;
                    }
                    // Create Photo
                    Photo::create([
                        'gallery_id' => $gallery->id,
                        'file' => $attr['file'],
                    ]);
                }
                DB::commit();

                return redirect()
                    ->route('admin.gallery.index')
                    ->with('success', __('Data Berhasil Ditambahkan.'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.gallery.index')
                ->with('error', __('Ada yang salah.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {

        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Admin\Gallery\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $attr = $request->validated();

        try {
            DB::beginTransaction();

            // Update Album
            $updateGallery = $gallery->update($attr);

            if ($request->file('file')) {
                if ($request->hasFile('file')) {
                    $images = $request->file('file');
                    foreach ($images as $image) {

                        if ($image->isValid()) {
                            $path = storage_path('app/public/upload/galeri/');
                            $filename = $image->hashName();

                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }

                            Image::make($image->getRealPath())->resize(500, 500, function ($constraint) {
                                $constraint->upsize();
                                $constraint->aspectRatio();
                            })->save($path . $filename);

                            $attr['file'] = $filename;
                        }
                        // Store Photo
                        Photo::create([
                            'gallery_id' => $gallery->id,
                            'file' => $attr['file'],
                        ]);
                    }

                    DB::commit();

                    return redirect()
                        ->route('admin.gallery.index')
                        ->with('success', __('Galeri Berhasil Diedit'));
                }
            } else {
                DB::commit();
                return redirect()
                    ->route('admin.gallery.index')
                    ->with('success', __('Galeri Berhasil Diedit'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.gallery.index')
                ->with(
                    'error',
                    __('Maaf, Data tidak bisa dihapus')
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        try {
            $path = storage_path('app/public/upload/galeri/');

            foreach ($gallery->photos as $photo) {
                if ($photo->file != null && file_exists($path . $photo->file)) {
                    unlink($path . $photo->file);
                    $photo->delete();
                    $gallery->delete();
                }
            }

            return redirect()
                ->route('admin.gallery.index')
                ->with('success', __('Data Berhasil Dihapus'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.gallery.index')
                ->with('error', __('Maaf, tidak bisa hapus galeri'));
        }
    }

    /**
     * Remove single image from storage.
     *
     * @param  \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function removeImage($id)
    {
        $photo = Photo::findOrFail($id);

        $path = storage_path('app/public/upload/galeri/');

        if (!$photo) abort(404);
        unlink($path . $photo->file);
        $photo->delete();
        return back()->with('success', 'Foto Berhasil Dihapus');
    }

    /**
     * Update single image from storage.
     *
     * @param  \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function updateImage($id)
    {
        $photo = Photo::findOrFail($id);
        $attr = request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);


        $image = request()->file('image');

        if ($image && $image->isValid()) {
            $path = storage_path('app/public/upload/galeri/');
            $filename = Str::random(40) . '.jpg';

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($image->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            // delete old file from storage
            if ($photo->file != null && file_exists($path . $photo->file)) {
                unlink($path . $photo->file);
            }

            $attr['file'] = $filename;
        }
        $photo->update([
            'file' => $attr['file']
        ]);
        return back()->with('success', 'Foto Berhasil Diedit');
    }
}
