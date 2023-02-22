@extends('frontend.layouts.app')
@section('content')
    <section class="banner_area w-100">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>{{ $project->name }}</h2>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('projects.index') }}">Projects</a>
                        <a href="javascript:void(0)">{{ $project->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Start Portfolio Details Area =================-->
    <section class="portfolio_details_area section_gap">
        <div class="container">
            <div class="portfolio_details_inner">
                <div class="row">
                    <div class="col-md-8">
                        <div class="left_img">
                            <img class="img-fluid w-auto" src="{{ $project->image() }}" alt="">
                        </div>
                        <div class="portfolio_right_text mt-30">
                            <h2 class="text-uppercase">{{ $project->name }}</h2>
                            <ul class="list-inline mt-3 mb-5 ul-info">
                                <li class="list-inline-item">
                                    <a href="{{ route('about') }}" class="text-dark   mr-4">
                                        <i class="fas fa-user"></i> <span>{{ $setting->author }}</span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-4">
                                    <a href="{{ route('projects.category', $project->category->slug) }}" class="text-dark ">
                                        <i class="fas fa-tag"></i> <span>{{ $project->category->name }}</span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-4">
                                    <a href="{{ $project->link }}" class="text-dark ">
                                        <i class="fas fa-link"></i> <span>
                                            @if ($project->link)
                                                {{ $project->link }}
                                            @else
                                                Unavaible
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-2">
                                    <a href="javascript:void(0)" class="text-dark ">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>{{ $project->created_at->translatedFormat('l, d F Y') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="description">
                            {!! $project->description !!}
                        </div>

                        <div class="tags mt-4">
                            <h3>Tags</h3>
                            @forelse ($project->tags as $tag)
                                <a href="{{ route('projects.tag', $tag->slug) }}"
                                    class="badge badge-secondary">{{ $tag->name }}</a>
                            @empty
                            @endforelse
                        </div>

                        <div class="portofolio-galeri mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="mb-3">Galeri Foto</h3>
                                </div>
                                @forelse ($project->galleries as $pg)
                                    <div class="col-md-3 col-6">
                                        <a class="img-fluid" href="{{ $pg->image() }}" data-lightbox="example-set"
                                            data-title="{{ $project->name }}">
                                            <img class="example-image mb-3 img-fluid" src="{{ $pg->image() }}" alt />
                                        </a>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <p>Foto Tidak Ditemukan!</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <x-Frontend.SidebarProjectRight />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Portfolio Details Area =================-->
@endsection
@push('styles')
    <style>
        .list li span {
            font-size: 12px;
            font-weight: normal;
        }

        .section_gap {
            padding: 100px 0 20px 0 !important;
        }

        .banner_area {
            background-image: none !important;
            min-height: 0 !important;
        }

        .ul-info a {
            font-size: 14px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/frontend/lightbox2-2.11.3/dist/css/lightbox.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/frontend/lightbox2-2.11.3/dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 100,
            'wrapAround': true,
            'fitImagesInViewport': true
        })
    </script>
@endpush
