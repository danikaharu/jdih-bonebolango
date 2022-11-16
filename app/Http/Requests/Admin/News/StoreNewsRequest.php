<?php

namespace App\Http\Requests\Admin\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreNewsRequest extends FormRequest
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
            'title' => 'required|min:3|unique:categories,title',
            'slug' => 'unique:categories,slug',
            'thumbnail' => 'required|image|mimetypes:image/jpg,image/jpeg,image/png|mimes:jpg,jpeg,png|dimensions:min_width=50,min_height=50',
            'body' => 'required|min:3',
            'caption' => 'nullable|min:3',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul berita wajib diisi',
            'title.min' => 'Judul berita minimal 3 kata',
            'title.unique' => 'Judul berita sudah ada',
            'thumbnail.required' => 'File wajib diupload',
            'thumbnail.image' => 'File yang anda pilih bukan gambar',
            'thumbnail.mimes' => 'Gambar yang diupload harus dengan extensi .jpg, .jpeg, atau .png',
            'thumbnail.dimensions' => 'Gambar minimal ukuran 50 x 50 px',
            'body.required' => 'Konten wajib diisi',
            'body.min' => 'Konten minimal 3 kata',
            'caption.min' => 'Konten minimal 3 kata',
        ];
    }
}
