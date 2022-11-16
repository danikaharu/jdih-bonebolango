<div class="row">
    <div class="mb-3 col-md-6">
        <label for="name" class="form-label">Nama</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
            value="{{ isset($survey) ? $survey->name : old('name') }}" />
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email</label>
        <input class="form-control  @error('email') is-invalid @enderror" type="text" name="email"
            value="{{ isset($survey) ? $survey->email : old('email') }}" />
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="subject" class="form-label">Subjek</label>
        <input class="form-control  @error('subject') is-invalid @enderror" type="text" name="subject"
            value="{{ isset($survey) ? $survey->subject : old('subject') }}" />
        @error('subject')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-12">
        <label for="comment" class="form-label">Komentar</label>
        <input class="form-control  @error('comment') is-invalid @enderror" type="text" name="comment"
            value="{{ isset($survey) ? $survey->comment : old('comment') }}" />
        @error('comment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
