<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
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
     * Store slug in database.
     *
     * 
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->input('title')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:App\Models\Category,id',
            'rule_number' => 'required|max:255',
            'year' => 'required|min:3|numeric',
            'determination_date' => 'required|date',
            'title' => 'required|min:5|max:255',
            'slug' => 'min:5|max:255',
            'file' => 'required|mimetypes:application/pdf',
            'status' => 'required|in:1,2, 3, 4, 5',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori peraturan wajib diisi',
            'category_id.exists' => 'Kategori peraturan tidak ada dalam daftar',
            'rule_number.required' => 'Nomor Peraturan wajib diisi',
            'rule_number.max' => 'Nomor Peraturan maksimal 255 kata',
            'year.required' => 'Tahun Peraturan wajib diisi',
            'year.min' => 'Tahun Peraturan minimal 3 kata',
            'year.numeric' => 'Tahun Peraturan harus angka, misalnya : 2022',
            'determination_date.required' => 'Tanggal Penetapan wajib diisi',
            'determination_date.date' => 'Tanggal Penetapan tidak valid',
            'title.required' => 'Judul peraturan wajib diisi',
            'title.min' => 'Judul peraturan minimal 5 kata',
            'title.max' => 'Judul peraturan maksimal 255 kata',
            'file.required' => 'File wajib diupload',
            'file.mimetypes' => 'File yang diupload harus dengan extensi .pdf',
            'status.required' => 'Status peraturan wajib diisi',
            'status.in' => 'Status peraturan tidak ada di dalam daftar',
        ];
    }
}
