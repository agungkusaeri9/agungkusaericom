@extends('frontend.layouts.app')
@section('content')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>
                    @isset($category)
                       "
                        {{ $category->name }}
                        "
                    @endisset
                    @isset($tag)
                      "
                        {{ $tag->name }}
                        "
                    @endisset

                    @if (request('q'))
                        "<i>{{ request('q') }}"
                    @endif

                    @if (!isset($category) && !isset($tag) && !request('q'))
                        Projects
                    @endif
                </h2>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('projects.index') }}">Projects</a>
                    @isset($category)
                        <a href="javascript:void(0)">Category</a>
                        <a href="{{ route('projects.category',$category->slug) }}" class="disabled"> {{ $category->name }}</a>
                    @endisset
                    @isset($tag)
                        <a href="javascript:void(0)">Tag</a>
                        <a href="{{ route('projects.tag',$tag->slug) }}" class="disabled"> {{ $tag->name }}</a>
                    @endisset
                    @if(request('q'))
                        <a href="javascript:void(0)">Search</a>
                        <a href="javascript:void(0)" class="disabled"> {{ request('q') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

    <!--================Blog Area =================-->
    <section class="blog_area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        @forelse ($projects as $project)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="{{ route('projects.category',$project->category->slug) }}">{{ $project->category->name }}</a>


                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="javascript:void(0)">{{ $setting->author }}<i class="lnr lnr-user"></i></a></li>
                                        <li><a href="javascript:void(0)">{{ $project->created_at->diffForHumans() }}<i class="lnr lnr-calendar-full"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ $project->image() }}" alt="">
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
{{-- @push('styles')
<style>
    .banner_inner {
        width: 100% !important;
    }
</style>
@endpush --}}
