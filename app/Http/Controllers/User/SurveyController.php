<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 kata',
            'name.max' => 'Nama maksimal 255 kata',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Diisi dengan email yang valid',
            'email.min' => 'Email minimal 3 kata',
            'email.max' => 'Email maksimal 255 kata',
            'rating.required' => 'Bintang wajib dipilih',
            'rating.in' => 'Bintang tidak masuk daftar',
            'subject.required' => 'Subjek wajib diisi',
            'subject.min' => 'Subjek minimal 3 kata',
            'subject.max' => 'Subjek maksimal 255 kata',
            'comment.required' => 'Komentar wajib diisi',
        ]);

        if ($validation->fails()) {
            return response()->json(['code' => 400, 'msg' => $validation->errors()->first()]);
        }

        $survey = new Survey();
        $survey->name = $request->name;
        $survey->email = $request->email;
        $survey->rating = $request->rating;
        $survey->comment = $request->comment;
        $survey->save();

        return response()->json(['code' => 200, 'msg' => 'Terima kasih telah melakukan survey']);
    }
}
