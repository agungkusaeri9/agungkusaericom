<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="img/favicon.png" type="image/png">
<link rel="icon" href="{{ $setting->favicon() }}" type="image/png" sizes="16x16">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stack('styles')
