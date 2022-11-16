<?php

namespace App\Http\Requests\RequestProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'job' => 'required|in:1,2, 3, 4',
            'request_title' => 'required|min:3|max:255',
            'request_purpose' => 'required|in:1,2, 3, 4,5',
        ];
    }

    public function messages()
    {
        return [
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
        ];
    }
}
