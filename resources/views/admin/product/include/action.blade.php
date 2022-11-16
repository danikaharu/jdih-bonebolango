{{-- <div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
            class="bx bx-dots-vertical-rounded"></i></button>
    <div class="dropdown-menu">

    </div>
</div> --}}
<div class="d-flex">
    <a class="btn btn-outline-primary btn-sm me-2" href="{{ route('admin.product.show', $slug) }}" target="blank"><i
            class="bx bx-show me-1"></i>
        Detail
    </a>
    <a class="btn btn-outline-secondary btn-sm me-2" href="{{ asset('storage/upload/produk/' . $file) }}"
        target="pdf-frame"><i class="bx bxs-file-pdf me-1"></i>
        Lihat Peraturan
    </a>
    <a class="btn btn-outline-dark btn-sm me-2" href="{{ route('admin.product.edit', $slug) }}"><i
            class="bx bx-edit-alt me-1"></i>
        Edit</a>
    <form action="{{ route('admin.product.destroy', $slug) }}" method="POST" role="alert"
        alert-title="Hapus {{ $title }}" alert-text="Yakin ingin menghapusnya?">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm me-2"><i class="bx bx-trash me-1"></i>
            Hapus</button>
    </form>

</div>
