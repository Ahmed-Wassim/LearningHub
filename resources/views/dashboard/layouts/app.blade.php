<!doctype html>
<html lang="en">


<!-- Mirrored from www.wrraptheme.com/templates/lucid/html/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Dec 2023 13:43:44 GMT -->

<head>
    @include('dashboard.layouts.head')
</head>

<body class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="https://www.wrraptheme.com/templates/lucid/html/assets/images/logo-icon.svg"
                    width="48" height="48" alt="Lucid"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- Overlay For Sidebars -->

    <div id="wrapper">

        @include('dashboard.layouts.nav')

        @include('dashboard.layouts.sidebar')

        <div id="main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </div>

    @include('dashboard.layouts.scripts')

</body>

</html>
