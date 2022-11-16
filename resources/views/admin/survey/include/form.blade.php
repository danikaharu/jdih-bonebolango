@push('style')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endpush

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
    <div class="mb-3 col-md-6">
        <div class="rate">
            <input type="radio" id="star5" class="rate" name="rating" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" checked id="star4" class="rate" name="rating" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" class="rate" name="rating" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" class="rate" name="rating" value="2">
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" class="rate" name="rating" value="1" />
            <label for="star1" title="text">1 star</label>
        </div>
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
