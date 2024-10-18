<!doctype html>
<html lang="en">

<head>
    <x-Frontend.Head></x-Frontend.Head>
    {!! seo($SEOData) !!}
</head>

<body>
    <!--================ Start Header Area =================-->
    <x-Frontend.Navbar />
    <!--================ End Header Area =================-->
    <div class="px-32 py-20">
        @yield('content')
    </div>

    <!--================Footer Area =================-->
    <x-Frontend.Footer />
    <!--================End Footer Area =================-->
    {{-- <x-Frontend.IconWa /> --}}

    <!-- Optional JavaScript -->
    @include('frontend.layouts.partials.scripts')
    <x-Frontend.Alert />
</body>

</html>
