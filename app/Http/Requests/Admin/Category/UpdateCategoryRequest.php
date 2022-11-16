<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCategoryRequest extends FormRequest
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
     * Store slug.
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
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'short_title' => 'required|regex:/^[\pL\s\-]+$/u',
            'slug' => 'min:5',
            'icon' => 'image|mimetypes:image/jpg,image/jpeg,image/png|mimes:jpg,jpeg,png|dimensions:min_width=40,min_height=40',
            'description' => 'required|regex:/^[\pL\s\-]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Nama kategori wajib diisi',
            'title.regex' => 'Nama kategori hanya boleh huruf',
            'short_title.required' => 'Singkatan wajib diisi',
            'short_title.regex' => 'Singkatan hanya boleh huruf',
            'icon.image' => 'File yang anda pilih bukan gambar',
            'icon.mimes' => 'Gambar yang diupload harus dengan extensi .jpg, .jpeg, atau .png',
            'icon.dimensions' => 'Gambar minimal ukuran 40 x 40 px',
            'description.required' => 'Deskripsi wajib diisi',
            'description.regex' => 'Deskripsi hanya boleh huruf',
        ];
    }
}
