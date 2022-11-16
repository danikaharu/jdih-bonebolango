{{-- <div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
            class="bx bx-dots-vertical-rounded"></i></button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.category.edit', $slug) }}"><i class="bx bx-edit-alt me-1"></i>
            Edit</a>
        <form action="{{ route('admin.category.destroy', $slug) }}" method="POST" role="alert"
            alert-title="Hapus {{ $short_title }}" alert-text="Yakin ingin menghapusnya?">
            @csrf
            @method('DELETE')
            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                Hapus</button>
        </form>
    </div>
</div> --}}

<div class="d-flex">
    <a class="btn btn-outline-dark btn-sm me-2" href="{{ route('admin.category.edit', $slug) }}"><i
            class="bx bx-edit-alt me-1"></i>
        Edit</a>
    <form action="{{ route('admin.category.destroy', $slug) }}" method="POST" role="alert"
        alert-title="Hapus {{ $short_title }}" alert-text="Yakin ingin menghapusnya?">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm me-2"><i class="bx bx-trash me-1"></i>
            Hapus</button>
    </form>
</div>
