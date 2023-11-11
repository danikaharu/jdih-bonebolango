<div class="row">
    <div class="mb-3 col-md-12">
        <label for="category_id" class="form-label">Kategori Peraturan <span class="text-danger"> &#42;</span></label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror ">
            <option value="" selected>-- {{ __('Pilih Kategori') }} --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ isset($product) && $product->category_id == $category->id ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="title" class="form-label">Judul Peraturan <span class="text-danger"> &#42;</span> <span> Contoh :
                Retribusi Pajak Usaha</span></label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
            value="{{ isset($product) ? $product->title : old('title') }}" />
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-3">
        <label for="rule_number" class="form-label">Nomor Peraturan <span class="text-danger"> &#42;</span></label>
        <input class="form-control @error('rule_number') is-invalid @enderror" type="text" name="rule_number"
            value="{{ isset($product) ? $product->rule_number : old('rule_number') }}" />
        @error('rule_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-3">
        <label for="year" class="form-label">Tahun Peraturan <span class="text-danger"> &#42;</span></label>
        <input class="form-control @error('year') is-invalid @enderror" type="text" name="year"
            value="{{ isset($product) ? $product->year : old('year') }}" />
        @error('year')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-3">
        <label for="determination_date" class="form-label">Tanggal Penetapan <span class="text-danger">
                &#42;</span></label>
        <input class="form-control @error('determination_date') is-invalid @enderror" type="date"
            name="determination_date"
            value="{{ isset($product) ? $product->determination_date : old('determination_date') }}" />
        @error('determination_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-3">
        <label for="status" class="form-label">Status Peraturan <span class="text-danger"> &#42;</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror ">
            <option value="" selected disabled>-- {{ __('Pilih Status') }} --</option>
            <option value="1"
                {{ isset($product) && $product->status == 1 ? 'selected' : (old('status') == '1' ? 'selected' : '') }}>
                Mengubah</option>
            <option value="2"
                {{ isset($product) && $product->status == 2 ? 'selected' : (old('status') == 2 ? 'selected' : '') }}>
                Diubah</option>
            <option value="3"
                {{ isset($product) && $product->status == 3 ? 'selected' : (old('status') == 3 ? 'selected' : '') }}>
                Mencabut</option>
            <option value="4"
                {{ isset($product) && $product->status == 4 ? 'selected' : (old('status') == 4 ? 'selected' : '') }}>
                Dicabut</option>
            <option value="5"
                {{ isset($product) && $product->status == 5 ? 'selected' : (old('status') == 5 ? 'selected' : '') }}>
                Berlaku</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @isset($product)
        <div class="mb-3 col-md-12">
            <div class="row">
                <div class="col-md-2">
                    @if ($product->file == null)
                        <label for="file" class="form-label">File Lama</label>
                        <img src="https://via.placeholder.com/350?text=File+Tidak+Ditemukan" alt="Peraturan"
                            class="rounded mb-2 mt-2" alt="Peraturan" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <label for="file" class="form-label">File Lama</label>
                        <div class="form-group">
                            <a href="{{ asset('storage/upload/produk/' . $product->file) }}" target="pdf-frame"
                                class="btn btn-outline-dark btn-sm"><i class="bx bxs-file-pdf me-1"></i>Lihat File</a>
                        </div>
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="form-group ms-3">
                        <label for="file" class="form-label">Upload Peraturan</label>
                        <input class="form-control  @error('file') is-invalid @enderror" type="file" name="file" />
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="mb-3 col-md-12">
            <label for="file" class="form-label">Upload Peraturan <span class="text-danger"> &#42;</span></label>
            <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" />
            @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endisset
</div>
