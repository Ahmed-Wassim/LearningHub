<!DOCTYPE html>
<html lang="en">

@include('site.layouts.head')

<body>
    @include('site.layouts.nav')

    @yield('hero')

    @yield('content')

    @include('site.layouts.footer')
</body>

</html>
