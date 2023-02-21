<!doctype html>
<html lang="en">

<head>
    <x-Frontend.Head></x-Frontend.Head>
</head>

<body>
    <!--================ Start Header Area =================-->
    <x-Frontend.Navbar />
    <!--================ End Header Area =================-->
    <div class="py-3">
        @yield('content')
    </div>

    <!--================Footer Area =================-->
    <x-Frontend.Footer />
    <!--================End Footer Area =================-->

    <!-- Optional JavaScript -->
    @include('frontend.layouts.partials.scripts')
</body>

</html>
