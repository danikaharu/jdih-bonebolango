<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin JDIH Bone Bolango</title>

    <meta name="csrf_token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template_admin/assets/img/favicon/favicon.ico') }} " />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.2/css/boxicons.css " />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/vendor/css/core.css') }} "
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('template_admin/assets/vendor/css/theme-default.css') }} "
        class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('template_admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.2/apexcharts.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/css/search.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('template_admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('template_admin/assets/js/config.js') }}"></script>

    @stack('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
</head>
