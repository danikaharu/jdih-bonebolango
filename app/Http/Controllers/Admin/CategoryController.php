<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $categories = Category::latest()->get();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', 'admin.category.include.action')
                ->toJson();
        }

        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $attr = $request->validated();

        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $path = storage_path('app/public/upload/kategori/');
            $filename = $request->file('icon')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('icon')->getRealPath())->resize(200, 200, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            $attr['icon'] = $filename;
        }

        Category::create($attr);

        return redirect('/admin/category')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $attr = $request->validated();

        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $path = storage_path('app/public/upload/kategori/');
            $filename = $request->file('icon')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('icon')->getRealPath())->resize(200, 200, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            // delete old icon from storage
            if ($category->icon != null && file_exists($path . $category->icon)) {
                unlink($path . $category->icon);
            }

            $attr['icon'] = $filename;
        }

        $category->update($attr);

        return redirect()->route('admin.category.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            // determine path icon
            $path = storage_path('app/public/upload/kategori/');

            // if icon exist remove file from directory
            if ($category->icon != null && file_exists($path . $category->icon)) {
                unlink($path . $category->icon);
            }

            $category->delete();
            return redirect()->route('admin.category.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.category.index')
                ->with('error', __('Maaf, Kategori tidak bisa dihapus.'));
        }
    }
}
