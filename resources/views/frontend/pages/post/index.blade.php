@extends('frontend.layouts.app')
@section('content')
    {{-- <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Blog</h2>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('posts.index') }}">Our Blog</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!--================Blog Area =================-->
    <section class="blog_area" style="margin-top: 100px">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @isset($category)
                    <div class="main_title text-left">
                        <h2 class="text-left">Category "
                            {{ $category->name }}
                            "
                        </h2>
                    </div>


                    @endisset
                    @isset($tag)
                    <div class="main_title text-left">
                        <h2 class="text-left">Tag "
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
                    <h2 class="text-left">BLOG</h2>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        @forelse ($posts as $post)
                            <article class="row blog_item">
                                <div class="col-md-3">
                                    <div class="blog_info text-right">
                                        <div class="post_tag">
                                            @forelse ($post->tags as $tag)
                                                <a href="#">{{ $tag->name }}</a>
                                            @empty
                                            @endforelse
                                        </div>
                                        <ul class="blog_meta list">
                                            <li><a href="#">{{ $post->user->name }}<i class="lnr lnr-user"></i></a>
                                            </li>
                                            <li><a href="#">{{ $post->created_at->diffForHumans() }}<i
                                                        class="lnr lnr-calendar-full"></i></a></li>
                                            <li><a href="#">{{ $post->visitor }} Views<i class="lnr lnr-eye"></i></a>
                                            </li>
                                            <li><a href="#">(satic) Comments<i class="lnr lnr-bubble"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="{{ $post->image() }}" alt="">
                                        <div class="blog_details">
                                            <a href="{{ route('posts.show', $post->slug) }}">
                                                <h2>{{ $post->title }}</h2>
                                            </a>
                                            <p>
                                                {{ $post->meta_description }}
                                            </p>
                                            <a href="{{ route('posts.show', $post->slug) }}" class="primary_btn"><span>View
                                                    More</span></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <p class="text-center">Artikel Tidak Ditemukan!</p>
                                </div>
                            </div>
                        @endforelse
                        {{ $posts->withQueryString()->links() }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <x-Frontend.SidebarRightPost />
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
