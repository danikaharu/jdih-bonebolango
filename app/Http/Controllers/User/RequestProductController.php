<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RequestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestProductController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'job' => ['required', 'in:1,2, 3, 4,5'],
            'request_title' => ['required', 'string', 'min:3', 'max:255'],
            'request_purpose' => ['required', 'in:1,2, 3, 4,5'],
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 kata',
            'name.max' => 'Nama maksimal 255 kata',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Diisi denga email yang valid',
            'email.min' => 'Email minimal 3 kata',
            'email.max' => 'Email maksimal 255 kata',
            'request_title.required' => 'Judul wajib diisi',
            'request_title.min' => 'Judul minimal 3 kata',
            'request_title.max' => 'Judul maksimal 255 kata',
            'job.required' => 'Pekerjaan wajib diisi',
            'job.in' => 'Pekerjaan tidak ada di dalam daftar',
            'request_purpose.required' => 'Tujuan Permohonan wajib diisi',
            'request_purpose.in' => 'Tujuan Permohonan tidak ada di dalam daftar',
        ]);

        if ($validation->fails()) {
            return response()->json(['code' => 400, 'msg' => $validation->errors()->first()]);
        }

        $requestProduct = new RequestProduct();
        $requestProduct->name = $request->name;
        $requestProduct->email = $request->email;
        $requestProduct->job = $request->job;
        $requestProduct->request_title = $request->request_title;
        $requestProduct->request_purpose = $request->request_purpose;
        $requestProduct->save();

        return response()->json(['code' => 200, 'msg' => 'Terima kasih telah bertanya, pesan anda akan disampaikan kepada operator']);
    }
}
