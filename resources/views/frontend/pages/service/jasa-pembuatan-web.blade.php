@extends('frontend.layouts.app')
@section('content')
    <section class="banner_area w-100">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Jasa Pembuatan Web</h2>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{javascript:void(0)">Services</a>
                        <a href="{javascript:void(0)">Jasa Pembuatan Web</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="portfolio_area" id="portfolio">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title mt-5">
                        <h2>PACKAGE</h2>
                        <p>
                            The following packages might be suitable for those of you who are currently looking and interested in building a web application.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row services">
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="title">Toko Online</h5>
                            <h4 class="price-diskon mb-2"><s>Rp. 2.000.000</s></h4>
                            <h3 class="price mb-4">Rp. 1.500.000<small class="small">/Tahun</small></h3>
                            <p>
                                Cocok bagi anda yang ingin mempunyai web toko online pribadi dengan desain yang menarik dan
                                juga interaktif.
                            </p>
                            <ul class="list">
                                <li><i class="fas fa-check-circle"></i> Gratis Hosting dan Domain selama 1 tahun</li>
                                <li><i class="fas fa-check-circle"></i></i> Pengerjaan 8 Hari</li>
                                <li><i class="fas fa-check-circle"></i> Full Source code</li>
                                <li><i class="fas fa-check-circle"></i> Free Maintenance satu bulan</li>
                                <li><i class="fas fa-check-circle"></i> SEO Friendly</li>
                            </ul>
                            <button class="btn btn-order btn-block btn-info mt-3 btnOrder" data-paket="Toko Online"><i
                                    class="fab fa-whatsapp"></i> Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="title">Company Profile</h5>
                            <h4 class="price-diskon mb-2"><s>Rp. 4.000.000</s></h4>
                            <h3 class="price mb-4">Rp. 3.500.000<small class="small">/Tahun</small></h3>
                            <p>
                                Anda mempunya bisnis sendiri dan ingin membuat bisnis anda diketahui banyak orang? paket ini
                                cocok untuk anda.
                            </p>
                            <ul class="list">
                                <li><i class="fas fa-check-circle"></i> Gratis Hosting dan Domain selama 1 tahun</li>
                                <li><i class="fas fa-check-circle"></i></i> Pengerjaan 10 Hari</li>
                                <li><i class="fas fa-check-circle"></i> Full Source code</li>
                                <li><i class="fas fa-check-circle"></i> Free Maintenance 3 bulan</li>
                                <li><i class="fas fa-check-circle"></i> SEO Friendly</li>
                                <li><i class="fas fa-check-circle"></i> Request desain (SK berlaku)</li>
                            </ul>
                            <button class="btn btn-order btn-block btn-info mt-3 btnOrder" data-paket="Company Profile"><i
                                    class="fab fa-whatsapp"></i> Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="title">Web Kustom</h5>
                            <div class="price-diskon mb-2">Mulai dari</div>
                            <h3 class="price mb-4">Rp. 500.000</h3>
                            <p>
                                Anda punya tugas atau ingin membuat aplikasi web sesuai yang anda inginkan bisa memilih
                                paket ini.
                            </p>
                            <ul class="list">
                                <li><i class="fas fa-check-circle"></i> Revisi 3x</li>
                                <li><i class="fas fa-check-circle"></i></i> Pengerjaan 7 - 28 Hari</li>
                                <li><i class="fas fa-check-circle"></i> Full Source code</li>
                                <li><i class="fas fa-check-circle"></i> Support 24/7</li>
                                <li><i class="fas fa-check-circle"></i> Request desain (SK berlaku)</li>
                            </ul>
                            <button class="btn btn-order btn-block btn-info mt-3 btnOrder" data-paket="Web Kustom"><i
                                    class="fab fa-whatsapp"></i> Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-Frontend.alert />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
    <style>
        .section_gap {
            padding: 100px 0 200px 0 !important;
        }

        .banner_area {
            background-image: none !important;
            min-height: 0 !important;
        }

        .services .card {
            font-family: sans-serif
        }

        .services h5.title {
            color: #494964;
            font-size: 22px !important;
            margin-bottom: 20px;
            font-family: sans-serif;
            font-weight: 600;
        }

        .services .small {
            font-size: 14px;
            font-weight: lighter !important;
        }

        .price-diskon {
            font-size: 16px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(function() {
            $('body').on('click', '.btnOrder', function() {
                let paket = $(this).data('paket');
                let no_wa = '{{ $setting->whatsapp_number }}';
                var today = new Date()
                var curHr = today.getHours()
                let waktu = null;

                if (curHr < 12) {
                    waktu = "Pagi";
                } else if (curHr < 15) {
                    waktu = "Siang";
                } else if (curHr < 18) {
                    waktu = "Sore";
                } else {
                    waktu = "Malam";
                }

                let message = `Selamat ${waktu},%0ASaya tertarik untuk memesan jasa pembuatan website paket ${paket}.%0AApakah Anda bisa membantu saya membuat website untuk bisnis saya?%0ATerimakasih`;
                let link = `https://wa.me/${no_wa}?text=${message}`;
                console.log(link);
                window.location.href = link;
            })
        })
    </script>
@endpush
