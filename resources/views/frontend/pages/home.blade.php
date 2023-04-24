@extends('frontend.layouts.app')
@section('content')
    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="banner_content">
                            <h3 class="text-uppercase">HELLO</h3>
                            <h1 class="text-uppercase">I am {{ $setting->site_name }}</h1>
                            <h5 class="text-uppercase">
                                {{ $setting->author_role }}
                            </h5>
                            <div class="d-flex align-items-center">
                                <a class="primary_btn" href="mailto:{{ $setting->email ?? '-' }}"><span>Hire Me</span></a>
                                <a class="primary_btn tr-bg" href="{{ route('download.cv') }}"><span>Get CV</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="home_right_img">
                            <img class="" src="{{ asset('assets/frontend/img/banner/home-right.png') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start About Us Area =================-->
    <section class="about_area section_gap">
        <div class="container">
            <div class="row justify-content-start align-items-center">
                <div class="col-lg-6">
                   <div class="text-center">
                    <img class="img-fluid mb-5" src="{{ $setting->image() }}" alt="">
                   </div>
                </div>
                <div class="col-lg-6">
                    <div class="main_title text-left">
                        <h2>let’s <br>
                            Introduce about <br>
                            myself</h2>
                        {!! $setting->description !!}
                        <a class="primary_btn" href="{{ route('download.cv') }}"><span>Download CV</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End About Us Area =================-->

    <!--================ Srart Brand Area =================-->
    <section class="brand_area section_gap_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <h2>Skills</h2>
                        <p>
                            Developing skills and becoming an expert in building attractive and responsive websites so that you might be interested in me
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="row">
                        @forelse ($skills as $skill)
                            <div class="col-lg-4 col-md-4 col-6">
                                <div class="single-brand-item d-table">
                                    <div class="d-table-cell text-center">
                                        <img src="{{ $skill->image() }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-cemter">Tidak Ada Data!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="offset-lg-2 col-lg-4 col-md-6">
                    <div class="client-info">
                        <div class="d-flex mb-50">
                            <span class="lage">2</span>
                            <span class="smll">Years Experience Working</span>
                        </div>
                        <div class="call-now d-flex">
                            <div>
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="ml-15">
                                <p>Call us now</p>
                                <h3>{{ $setting->phone }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Brand Area =================-->

    <!--================ Start Features Area =================-->
    <section class="features_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <h2>service offers </h2>
                        <p>
                            I am a professional who provides quality services to meet your business needs
                        </p>
                    </div>
                </div>
            </div>
            <div class="row feature_inner justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="feature_item">
                        <img src="{{ asset('assets/frontend/img/services/s3.png') }}" alt="">
                        <h4>Web Depelopment</h4>
                        <p>Creating a web application according to your needs</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature_item">
                        <img src="{{ asset('assets/frontend/img/services/s1.png') }}" alt="">
                        <h4>Web Design</h4>
                        <p>Creating an attractive and interactive web design</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================ End Features Area =================-->

    <!--================Start Portfolio Area =================-->
    <section class="portfolio_area" id="portfolio">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <h2>Projects </h2>
                        <p>
                            I have several portfolios that I have created up until now. You can see them directly
                        </p>
                    </div>
                </div>
            </div>

            <div class="filters-content">
                <div class="row portfolio-grid justify-content-center">
                    @forelse ($projects as $project)
                        <div class="col-lg-4 col-md-6 all {{ $project->project_category_id }}">
                            <div class="portfolio_box">
                                <div class="single_portfolio">
                                    {{-- <img class="img-fluid w-100" src="{{ $project->image() }}" alt=""> --}}
                                    <div class="bg-image-portfolio"
                                        style="background-image:url('{{ $project->image() }}')">

                                    </div>
                                    <div class="overlay"></div>
                                    <a href="{{ $project->image() }}" class="img-gal">
                                        <div class="icon">
                                            <span class="lnr lnr-cross"></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="short_info">
                                    <h4><a href="{{ route('projects.show',$project->slug) }}">{{ $project->name }}</a></h4>
                                    <p>{{ $project->meta_description }}</p>
                                    <p>
                                        @foreach ($project->tags as $tag)
                                            <a href="{{ route('projects.tag',$tag->slug) }}" class="badge badge-info">{{ $tag->name }}</a>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">
                                Data Tidak Ada!
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!--================End Portfolio Area =================-->

    <!--================ Start Testimonial Area =================-->
    {{-- <div class="testimonial_area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="main_title">
                    <h2>client say about me</h2>
                    <p>Is give may shall likeness made yielding spirit a itself togeth created after sea is in beast <br>
                         beginning signs open god you're gathering ithe</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="testi_slider owl-carousel">
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/frontend/img/testimonials/t1.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Elite Martin</h4>
                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/frontend/img/testimonials/t2.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Davil Saden</h4>
                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/frontend/img/testimonials/t1.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Elite Martin</h4>
                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/frontend/img/testimonials/t2.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Davil Saden</h4>
                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/frontend/img/testimonials/t1.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Elite Martin</h4>
                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('assets/frontend/img/testimonials/t2.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Davil Saden</h4>
                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <!--================ End Testimonial Area =================-->

    {{-- <!--================ Start Newsletter Area =================-->
<section class="newsletter_area">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="subscription_box text-center">
                    <h2 class="text-uppercase text-white">get update from anywhere</h2>
                    <p class="text-white">
                        Bearing Void gathering light light his eavening unto dont afraid.
                    </p>
                    <div class="subcribe-form" id="mc_embed_signup">
                        <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscription relative">
                            <input name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required="" type="email">
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                            </div>
                            <button class="primary-btn hover d-inline">Get Started</button>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Newsletter Area =================--> --}}
    <x-Frontend.Alert />
@endsection
@push('styles')
    <style>
        #portfolio .bg-image-portfolio {
            height: 230px;
            background-position: center;
            background-size: cover;
        }

        .home_banner_area {
            background: none;
        }

        @media (max-width: 576px) {
            .about_area img{
                max-height: 320px;
            }
        }
    </style>
@endpush
