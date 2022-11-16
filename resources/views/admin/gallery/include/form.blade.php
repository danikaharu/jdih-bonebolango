<div class="row">
    <div class="mb-3 col-md-12">
        <label for="title" class="form-label">Judul Kegiatan <span class="text-danger"> &#42;</span></label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
            value="{{ isset($gallery) ? $gallery->title : old('title') }}" />
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="description" class="form-label">Deskripsi <span class="text-danger"> &#42;</span></label>
        <textarea id="description" name="description" cols="40"
            class="form-control @error('description') is-invalid @enderror">{{ isset($gallery) ? $gallery->description : old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <div class="form-group img-div">
            <label for="file" class="form-label">Gambar <span class="text-danger"> &#42;</span></label>
            <div class="input-group">
                <input class="form-control  @error('file') is-invalid @enderror" type="file" name="file[]" />
                <button class="btn btn-primary btn-add-more" type="button"><i class="bx bx-plus"></i></button>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="clone hide" style="display: none;">
            <div class="form-group control-group" style="margin-top:10px">
                <div class="input-group mb-3">
                    <input type="file" name="file[]" class="form-control">
                    <button class="btn btn-danger btn-remove" type="button"><i class="bx bx-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // button add more
            $(".btn-add-more").click(function() {
                var html = $(".clone").html();
                $(".img-div").after(html);
            });
            // button remove
            $("body").on("click", ".btn-remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endpush
