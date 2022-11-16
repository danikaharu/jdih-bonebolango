<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\{StoreProductRequest, UpdateProductRequest};
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $products = Product::with('category')->latest()->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', 'admin.product.include.action')
                ->toJson();
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $attr = $request->validated();

        if ($request->file('file') && $request->file('file')->isValid()) {

            $filename = $request->file('file')->hashName();
            $request->file('file')->storeAs('upload/produk', $filename, 'public');

            $attr['file'] = $filename;
        }

        Product::create($attr);

        return redirect()->route('admin.product.index')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('category:id,title');
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->load('category:id,title');
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $attr = $request->validated();

        if ($request->file('file') && $request->file('file')->isValid()) {

            $path = storage_path('app/public/upload/produk/');
            $filename = $request->file('file')->hashName();
            $request->file('file')->storeAs('upload/produk', $filename, 'public');

            // delete old file from storage
            if ($product->file != null && file_exists($path . $product->file)) {
                unlink($path . $product->file);
            }

            $attr['file'] = $filename;
        }

        $product->update($attr);

        return redirect()->route('admin.product.index')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            // determine path file
            $path = storage_path('app/public/upload/produk/');

            // if product exist remove file from directory
            if ($product->file != null && file_exists($path . $product->file)) {
                unlink($path . $product->file);
            }

            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.product.index')
                ->with('error', __('Maaf, Produk Hukum tidak bisa dihapus.'));
        }
    }
}
