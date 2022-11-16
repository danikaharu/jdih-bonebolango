<div class="row">
    <div class="mb-3 col-md-6">
        <label for="title" class="form-label">Nama Kategori <span class="text-danger"> &#42;</span></label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
            value="{{ isset($category) ? $category->title : old('title') }}" />
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label for="short_title" class="form-label">Singkatan <span class="text-danger"> &#42;</span></label>
        <input class="form-control  @error('short_title') is-invalid @enderror" type="text" name="short_title"
            value="{{ isset($category) ? $category->short_title : old('short_title') }}" />
        @error('short_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @isset($category)
        <div class="mb-3 col-md-12">
            <div class="row">
                <div class="col-md-3">
                    @if ($category->icon == null)
                        <label for="icon" class="form-label">Gambar Lama</label>
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Icon"
                            class="rounded mb-2 mt-2" alt="Icon" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <label for="icon" class="form-label">Gambar Lama</label>
                        <img src="{{ asset('storage/upload/kategori/' . $category->icon) }}" alt="Icon"
                            class="rounded mb-2 mt-2" width="200" height="150" style="object-fit: cover">
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="form-group ms-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input class="form-control  @error('icon') is-invalid @enderror" type="file" name="icon" />
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="mb-3 col-md-12">
            <label for="icon" class="form-label">Icon</label>
            <input class="form-control  @error('icon') is-invalid @enderror" type="file" name="icon" />
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endisset
    <div class="mb-3 col-md-12">
        <label for="description" class="form-label">Deskripsi <span class="text-danger"> &#42;</span></label>
        <input class="form-control  @error('description') is-invalid @enderror" type="text" name="description"
            value="{{ isset($category) ? $category->description : old('description') }}" />
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
