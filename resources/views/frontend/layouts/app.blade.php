<!doctype html>
<html lang="en">

<head>
    <x-Frontend.Head></x-Frontend.Head>
    {!! seo($SEOData) !!}
</head>

<body class="relative">
    <!--================ Start Header Area =================-->
    <x-Frontend.Navbar />
    <!--================ End Header Area =================-->
    {{-- <div class="container mx-auto min-h-screen max-w-7xl px-4 sm:px-6 lg:px-8">
    </div> --}}
    @yield('content')

    <!--================Footer Area =================-->
    <x-Frontend.Footer />
    <!--================End Footer Area =================-->
    <x-Frontend.IconWa />

    <!-- Optional JavaScript -->
    @include('frontend.layouts.partials.scripts')
    <x-Frontend.Toast />
</body>

</html>
