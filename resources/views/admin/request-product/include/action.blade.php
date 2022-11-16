{{-- <div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
            class="bx bx-dots-vertical-rounded"></i></button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.request-product.show', $id) }}" target="blank"><i
                class="bx bx-show me-1"></i>
            Detail
        </a>
        <form action="{{ route('admin.request-product.destroy', $id) }}" method="POST" role="alert"
            alert-title="Hapus {{ $request_title }}" alert-text="Yakin ingin menghapusnya?">
            @csrf
            @method('DELETE')
            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                Hapus</button>
        </form>
    </div>
</div> --}}
<div class="d-flex">
    <a class="btn btn-outline-primary btn-sm me-2" href="{{ route('admin.request-product.show', $id) }}" target="blank"><i
            class="bx bx-show me-1"></i>
        Detail
    </a>
    <form action="{{ route('admin.request-product.destroy', $id) }}" method="POST" role="alert"
        alert-title="Hapus {{ $request_title }}" alert-text="Yakin ingin menghapusnya?">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm me-2"><i class="bx bx-trash me-1"></i>
            Hapus</button>
    </form>
</div>
