<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!--
        <link rel="stylesheet" href="/bootstrap/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/fontawesome/vendor/components/font-awesome/css/all.min.css">
    -->
    <!-- link rel="stylesheet" href="/css/styles.css" -->
    <style type="text/css">
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 193, 7;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-body-color-rgb: 33, 37, 41;
            --bs-body-bg-rgb: 255, 255, 255;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #212529;
            --bs-body-bg: #fff;
        }

        .container,
        .container-fluid,
        .container-xxl,
        .container-xl,
        .container-lg,
        .container-md,
        .container-sm {
            width: 100%;
            padding-right: 0.75rem;
            padding-left: 0.75rem;
            margin-right: auto;
            margin-left: auto;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table {
            caption-side: bottom;
            border-collapse: collapse;
            border: 0px solid #ddd;
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        .table>tbody {
            vertical-align: inherit;
        }

        .table>thead {
            vertical-align: bottom;
        }

        .table> :not(:last-child)> :last-child>* {
            border-bottom-color: currentColor;
        }

        .table-hover {
            color: #212529;
        }

        th {
            text-align: inherit;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .display-6 {

            font-weight: 300;
            line-height: 1.2;
        }

        body {

            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 80%;

        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: #6c757d;
            text-align: center;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            color: #6c757d;
            text-align: center;
            height: 50px;
        }

        section {
            page-break-after: always;
        }

        section:last-child {
            page-break-after: avoid;
        }

    </style>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @yield('headscript')
</head>

<body class="">

    <header>
        <p></p>
        <hr>
    </header>

    <footer>
        <hr>
        <p>Rockfeller Ingleses</p>
    </footer>

    <main>
        @yield('content')
    </main>



    <script src="/js/jQuery.js"></script>
    <script src="/js/inputmask.js"></script>
    <script src="/js/inputmask.binding.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/echarts.min.js"></script>
    <script src="/js/chartisan_echarts.js"></script>
</body>

</html>
