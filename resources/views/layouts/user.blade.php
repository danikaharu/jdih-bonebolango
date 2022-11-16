<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.user.head')

<body>

    @include('partials.user.navbar')

    @yield('content')



    @include('partials.user.footer')
</body>

@include('partials.user.scripts')

</html>
