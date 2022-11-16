<?php

namespace App\Http\Requests\Admin\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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
            'rating' => 'in:1,2,3,4,5',
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
            'comment.required' => 'Komentar wajib diisi',
        ];
    }
}
