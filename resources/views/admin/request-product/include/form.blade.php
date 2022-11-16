<div class="row">
    <div class="mb-3 col-md-6">
        <label for="name" class="form-label">Nama <span class="text-danger"> &#42;</span></label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
            value="{{ isset($request) ? $request->name : old('name') }}" />
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email <span class="text-danger"> &#42;</span></label>
        <input class="form-control  @error('email') is-invalid @enderror" type="text" name="email"
            value="{{ isset($request) ? $request->email : old('email') }}" />
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="job" class="form-label">Pekerjaan <span class="text-danger"> &#42;</span></label>
        <select name="job" class="form-select @error('job') is-invalid @enderror ">
            <option value="" selected disabled>-- {{ __('Pilih Pekerjaan') }} --</option>
            <option value="1"
                {{ isset($request) && $request->job == 1 ? 'selected' : (old('job') == '1' ? 'selected' : '') }}>
                Pelajar/Mahasiswa/Akademisi</option>
            <option value="2"
                {{ isset($request) && $request->job == 2 ? 'selected' : (old('job') == 2 ? 'selected' : '') }}>
                Profesional</option>
            <option value="3"
                {{ isset($request) && $request->job == 3 ? 'selected' : (old('job') == 3 ? 'selected' : '') }}>
                Wirausaha</option>
            <option value="4"
                {{ isset($request) && $request->job == 4 ? 'selected' : (old('job') == 4 ? 'selected' : '') }}>
                Pemerintahan</option>
        </select>
        @error('job')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="request_title" class="form-label">Judul Permintaan Peraturan <span class="text-danger">
                &#42;</span></label>
        <input class="form-control  @error('request_title') is-invalid @enderror" type="text" name="request_title"
            value="{{ isset($request) ? $request->request_title : old('request_title') }}" />
        @error('request_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="request_purpose" class="form-label">Tujuan Permintaan Peraturan <span class="text-danger">
                &#42;</span></label>
        <select name="request_purpose" class="form-select @error('request_purpose') is-invalid @enderror ">
            <option value="" selected disabled>-- {{ __('Pilih Tujuan') }} --</option>
            <option value="1"
                {{ isset($request) && $request->request_purpose == 1 ? 'selected' : (old('request_purpose') == '1' ? 'selected' : '') }}>
                Referensi Kajian Bisnis</option>
            <option value="2"
                {{ isset($request) && $request->request_purpose == 2 ? 'selected' : (old('request_purpose') == 2 ? 'selected' : '') }}>
                Referensi Pembuatan Kebijakan</option>
            <option value="3"
                {{ isset($request) && $request->request_purpose == 3 ? 'selected' : (old('request_purpose') == 3 ? 'selected' : '') }}>
                Referensi Pembuatan Kurikulum</option>
            <option value="4"
                {{ isset($request) && $request->request_purpose == 4 ? 'selected' : (old('request_purpose') == 4 ? 'selected' : '') }}>
                Referensi Tugas/Karya Ilmiah</option>
            <option value="5"
                {{ isset($request) && $request->request_purpose == 4 ? 'selected' : (old('request_purpose') == 4 ? 'selected' : '') }}>
                Referensi Pribadi</option>
        </select>
        @error('request_purpose')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
