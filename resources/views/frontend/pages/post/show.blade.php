@extends('frontend.layouts.app')
@section('content')
    <!--================ Start Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Detail</h2>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('posts.index') }}">Blog</a>
                        <a class="disabled">{{ $post->title }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section>
    <div class="row">
        <div class="col-md-12">
            <div class="main_title text-left">
                <h2 class="text-center">BLOG</h2>
            </div>
        </div>
    </div>
</section> --}}
    <!--================ End Banner Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area mt-1 single-post-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="{{ $post->image() }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">

                        </div>
                        <div class="col-lg-12">
                            <h2 class="mt-3 mb-2">{{ $post->title }}</h2>

                          <div class="description">
                            {!! $post->description !!}
                          </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>{{ $post->comments_count }} Comments</h4>
                        @forelse ($post->comments as $comment)
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="img/blog/c1.jpg" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5><a href="#">{{ $comment->name }}</a></h5>
                                            <p class="date">{{ $comment->created_at->translatedFormat('l, d F Y H:i:s') }}
                                            </p>
                                            <p class="comment">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="reply-btn">
                                        <a href="javascript:void(0)" data-commentid="{{ $comment->id }}"
                                            class="btn-reply btnReplay text-uppercase">reply</a>
                                    </div>
                                </div>
                            </div>
                            @foreach ($comment->child as $child)
                                <div class="comment-list left-padding ml-5">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="img/blog/c3.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <h5><a href="#">{{ $child->name }}</a></h5>
                                                <p class="date">
                                                    {{ $child->created_at->translatedFormat('l, d F Y H:i:s') }}</p>
                                                <p class="comment">
                                                    {{ $child->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <p class="text-center">
                                No Comment!
                            </p>
                        @endforelse
                        {{-- <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form action="{{ route('posts.comment') }}" method="post">
                            @csrf
                            <input type="hidden" name="parent_id">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group form-inline">
                                @if (request()->session()->has('name'))
                                    <input type="hidden" name="name" value="{{ request()->session()->get('name') }}">
                                @else
                                    <div class="form-group col-lg-6 col-md-6 name">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                                            id="name" placeholder="Enter Name" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Name'" name="name" required>
                                        @error('name')
                                            <div class="text-left invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endif

                                @if (request()->session()->has('email'))
                                    <input type="hidden" name="email" value="{{ request()->session()->get('email') }}">
                                @else
                                    <div class="form-group col-lg-6 col-md-6 email">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror "
                                            id="email" placeholder="Enter Email" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Email'" name="email" required>
                                        @error('email')
                                            <div class="text-left invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <textarea class="form-control @error('comment') is-invalid @enderror  mb-10" rows="5" name="comment"
                                    placeholder="Comment" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Comment'" required=""></textarea>
                                @error('comment')
                                    <div class="text-left invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if (!request()->session()->has('name'))
                                <div class="form-group text-left form-check">
                                    <input type="checkbox" class="form-check-input" name="save_info" id="save_info">
                                    <label class="form-check-label" for="save_info">Store name and email information</label>
                                </div>
                            @endif
                            <button class="primary-btn primary_btn"><span>Post Comment</span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <x-Frontend.SidebarRightPost />
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
    <x-Frontend.Alert />
@endsection
@push('scripts')
    <script>
        $(function() {
            $('body').on('click', '.btnReplay', function() {
                let comment_id = $(this).data('commentid');
                $('html, body').animate({
                    scrollTop: $(".comment-form").offset().top
                }, 1000);
                $('input[name=parent_id]').val(comment_id);
            })
            $('.description img').addClass('img-fluid');
        })

    </script>
@endpush
