<?php

namespace App\Http\Requests\Admin\Gallery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreGalleryRequest extends FormRequest
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
            'slug' => Str::slug($this->input('title'))
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
            'title' => 'required|string|max:255',
            'description' => 'required',
            'file' => 'required',
            'file.*' => 'image|mimetypes:image/jpg,image/jpeg,image/png|mimes:jpg,jpeg,png|dimensions:min_width=50,min_height=50',
            'slug' => 'unique:categories,slug',
            'user_id' => 'exists:App\Models\User,id',
        ];
    }

    /**
     * Get the validation message based on rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'Judul wajib diisi',
            'title.string' => 'Judul berupa huruf',
            'title.max' => 'Judul terlalu panjang',
            'description.required' => 'Deskripsi wajib diisi',
            'file.required' => 'Pilih gambar terlebih dahulu',
            'file.image' => 'File yang anda pilih bukan gambar',
            'file.mimetypes' => 'Gambar yang diupload harus dengan extensi .jpg, .jpeg, atau .png',
            'file.dimensions' => 'Gambar minimal ukuran 50 x 50 px',
        ];
    }
}
