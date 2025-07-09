<head>
    <base href="../" />
    <title>@yield('title') | {{ config('app.name', 'E-Office') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <meta name="description" content="Sipagi" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Sipagi" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('logo/logo.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    {{-- Icon --}}
    {{-- <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!--begin::Vendor Stylesheets(used for this page only)-->

    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/toastify.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        :root {
            --office-color: #004af7;
        }

        [data-kt-app-layout=dark-sidebar] .app-sidebar .menu .menu-item .menu-link.active {
            transition: color .2s ease;
            background-color: var(--office-color);
            --bs-nav-link-color: var(--office-color);
            color: var(--office-color);
        }

        .active>.page-link,
        .page-link.active {
            z-index: 3;
            color: var(--bs-pagination-active-color);
            background-color: #004af7;
            border-color: var(--bs-pagination-active-border-color);
        }
    </style>
    @stack('css')
</head>
