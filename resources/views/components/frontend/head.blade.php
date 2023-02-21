<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="img/favicon.png" type="image/png">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/vendors/linericon/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/vendors/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/vendors/nice-select/css/nice-select.css') }}">
<link rel="icon" href="{{ $setting->favicon() }}" type="image/png" sizes="16x16">
<!-- main css -->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
{!! SEO::generate() !!}
@vite(['resources/js/app.js'])
@stack('styles')
