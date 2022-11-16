<ul class="nav nav-pills flex-column flex-md-row mb-3">
    @foreach ($profiles as $data)
        <li class="nav-item "><a
                class="nav-link {{ request()->is('admin/profile/' . $data->slug . '') ? ' active' : '' }}"
                href="{{ route('admin.profile.show', $data->slug) }}">
                {{ $data->title }}</a></li>
    @endforeach
</ul>
