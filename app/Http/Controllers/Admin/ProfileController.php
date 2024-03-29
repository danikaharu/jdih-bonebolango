<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('admin.profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $attr = $request->validated();

        $dom = new \DOMDocument();
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // preg_match('/data:image\/(?.*?)\;/',$src,$groups);
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid();
                $filepath = ("storage/upload/profil/$filename.$mimetype");

                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        $attr['body'] = $dom->saveHTML();

        $profile->update($attr);
        $attr['slug'] = Str::slug($attr['title']);

        return redirect()->route('admin.profile.show',  $attr['slug'])->with('success', 'Data Berhasil Diupdate');
    }
}
