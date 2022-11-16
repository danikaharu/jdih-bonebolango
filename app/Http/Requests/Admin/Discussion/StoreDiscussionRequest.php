<?php

namespace App\Http\Requests\Admin\Discussion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreDiscussionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->input('subject'))
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'subject' => 'required|min:3|max:255',
            'slug' => 'unique:discussions,slug',
            'comment' => 'required',
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
            'subject.required' => 'Subjek wajib diisi',
            'subject.min' => 'Subjek minimal 3 kata',
            'subject.max' => 'Subjek maksimal 255 kata',
            'comment.required' => 'Komentar wajib diisi',
        ];
    }
}
