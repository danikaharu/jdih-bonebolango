@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" rel="stylesheet">
@endpush

<div class="row">
    <div class="mb-3 col-md-12">
        <label for="title" class="form-label">Judul Berita <span class="text-danger"> &#42;</span></label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
            value="{{ isset($news) ? $news->title : old('title') }}" />
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="body" class="form-label">Konten <span class="text-danger"> &#42;</span></label>
        <textarea id="body" name="body" cols="30" rows="10"
            class="form-control @error('body') is-invalid @enderror">{{ isset($news) ? $news->body : old('body') }}</textarea>
        @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @isset($news)
        <div class="mb-3 col-md-12">
            <div class="row">
                <div class="col-md-3">
                    @if ($news->thumbnail == null)
                        <label for="thumbnail" class="form-label">Gambar Lama</label>
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Thumbnail"
                            class="rounded mb-2 mt-2" alt="Thumbnail" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <label for="thumbnail" class="form-label">Gambar Lama</label>
                        <img src="{{ asset('storage/upload/berita/' . $news->thumbnail) }}" alt="Thumbnail"
                            class="rounded mb-2 mt-2" width="200" height="150" style="object-fit: cover">
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="form-group ms-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input class="form-control  @error('thumbnail') is-invalid @enderror" type="file"
                            name="thumbnail" />
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="mb-3 col-md-12">
            <label for="thumbnail" class="form-label">Thumbnail <span class="text-danger"> &#42;</span></label>
            <input class="form-control  @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" />
            @error('thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endisset
    <div class="mb-3 col-md-12">
        <label for="caption" class="form-label">Caption</label>
        <input class="form-control @error('caption') is-invalid @enderror" type="text" name="caption"
            value="{{ isset($news) ? $news->caption : old('caption') }}" />
        @error('caption')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#body').summernote({
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['help']],
                ],
            });
        });
    </script>
@endpush
