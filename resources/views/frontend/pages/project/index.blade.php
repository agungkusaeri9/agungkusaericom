@extends('frontend.layouts.app')
@section('content')
{{-- <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Project</h2>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('projects.index') }}">Projects</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!--================Blog Area =================-->
    <section class="blog_area mt-5">
        <div class="container">
            <div class="row" style="margin-top: 100px">
                <div class="col-md-8">
                    @isset($category)
                    <div class="main_title text-left">
                        <h2 class="text-left">PROJECT Category "
                            {{ $category->name }}
                            "
                        </h2>
                    </div>


                    @endisset
                    @isset($tag)
                    <div class="main_title text-left">
                        <h2 class="text-left">PROJECT Tag "
                            {{ $tag->name }}
                            "
                        </h2>
                    </div>
                    @endisset

                    @if(request('q'))
                    <div class="main_title text-left">
                        <h2 class="text-left">Hasil Pencarian "
                           <i> {{ request('q') }}</i>
                            "
                        </h2>
                    </div>
                    @endif

                    @if (!isset($category) && !isset($tag) && !request('q'))
                    <div class="main_title text-left">
                    <h2 class="text-left">PROJECTS</h2>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        @forelse ($projects as $project)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">{{ $project->category->name }}</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">{{ $setting->author }}<i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">{{ $project->created_at->diffForHumans() }}<i class="lnr lnr-calendar-full"></i></a></li>
                                        <li><a href="#">{{ $project->visitor }} Views<i class="lnr lnr-eye"></i></a></li>
                                        <li><a href="#">(satic) Comments<i class="lnr lnr-bubble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ asset('assets/frontend/img/blog/main-blog/m-blog-1.jpg') }}" alt="">
                                    <div class="blog_details">
                                        <a href="{{ route('projects.show',$project->slug) }}">
                                            <h2>{{ $project->name }}</h2>
                                        </a>
                                        <p>
                                            {{ $project->meta_description }}
                                        </p>
                                        <a href="{{ route('projects.show',$project->slug) }}" class="primary_btn"><span>View More</span></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <p class="text-center">Project Tidak Ditemukan!</p>
                                </div>
                            </div>
                        @endforelse
                        {{ $projects->withQueryString()->links() }}
                    </div>
                </div>
                <div class="col-lg-4">
                   <x-Frontend.SidebarProjectRight />
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
@push('styles')
    <style>
        .kotak-gambar{
            height: 200px;
            width: 200px;
            background-image: url('{{ $setting->author_image }}');
            background-position:center;
            background-size: 200px;
            border-radius:50%;
            text-align: center;
        }
    </style>
@endpush
