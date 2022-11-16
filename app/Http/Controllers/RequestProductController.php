<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProduct\StoreRequestProduct;
use App\Models\RequestProduct;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class RequestProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $requests = RequestProduct::latest()->get();
            return DataTables::of($requests)
                ->addIndexColumn()
                ->addColumn('action', 'admin.request-product.include.action')
                ->toJson();
        }

        return view('admin.request-product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.request-product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RequestProduct\StoreRequestProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestProduct $request)
    {
        $attr = $request->validated();

        RequestProduct::create($attr);

        return redirect()->route('admin.request-product.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestProduct  $requestProduct
     * @return \Illuminate\Http\Response
     */
    public function show(RequestProduct $requestProduct)
    {
        return view('admin.request-product.show', compact('requestProduct'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestProduct  $requestProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestProduct $requestProduct)
    {
        try {
            $requestProduct->delete();

            return redirect()
                ->route('admin.request-product.index')
                ->with('success', __('Data Berhasil Dihapus'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.request-product.index')
                ->with('error', __('Maaf, data tidak bisa dihapus'));
        }
    }
}
