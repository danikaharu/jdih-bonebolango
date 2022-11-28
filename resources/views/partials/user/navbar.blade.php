<nav class="navbar fixed-top navbar-expand-lg p-md-3">
    <div class="container">

        <a class="navbar-brand" href="#"><img src="{{ asset('template_user/assets/img/logo/logo.svg') }} "
                alt="logo" width="250"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? ' active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('berita', 'berita/*') ? ' active' : '' }}"
                        href="{{ route('berita') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profil') ? ' active' : '' }}"
                        href="{{ route('profil') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('galeri', 'galeri/*') ? ' active' : '' }}"
                        href="{{ route('galeri') }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('forum', 'forum/*') ? ' active' : '' }}"
                        href="{{ route('forum') }}">Tanya Jawab</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk') ? ' active' : '' }}"
                        href="{{ route('produk') }}">Produk Hukum</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
