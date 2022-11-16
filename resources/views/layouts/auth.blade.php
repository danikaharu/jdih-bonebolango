<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<!-- Head -->
@include('partials.auth.head')
<!-- / Head -->

<body>

    <!-- Content -->
    @yield('content')
    <!-- / Content -->

    <!-- Scripts -->
    @include('partials.auth.scripts')
    <!-- / Scripts -->

</body>

</html>
