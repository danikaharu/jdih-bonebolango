{{ $gallery->title }}

{{ $gallery->vzt()->count() }}

{!! $gallery->description !!}


<img src="{{ Storage::url($gallery->thumbnail) }}" alt="">
