@extends('frontend.layouts.app')
@section('content')
<section class="banner_area w-100">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>About Me</h2>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('about') }}">About Me</a>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="about_area section_gap">
        <div class="container">
            <div class="row justify-content-start align-items-center">
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ $setting->image() }}" alt="">
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
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-brand-item d-table">
                                    <div class="d-table-cell text-center">
                                        <img src="{{ $skill->image() }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Tidak Ada Data!</p>
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
@endsection

@push('styles')
    <style>
        .list li span {
            font-size: 12px;
            font-weight: normal;
        }

        .section_gap {
            padding: 100px 0 200px 0 !important;
        }

        .banner_area {
            background-image: none !important;
            min-height: 0 !important;
        }
    </style>
@endpush
