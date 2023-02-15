<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Posts">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i
                        class="lnr lnr-magnifier"></i></button>
            </span>
        </div><!-- /input-group -->
        <div class="br"></div>
    </aside>
    <aside class="single_sidebar_widget author_widget">
       <div class="d-flex justify-content-center">
        <div class="kotak-gambar"></div>
       </div>
        <h4>{{ $setting->author }}</h4>
        <p>{{ $setting->author_description }}</p>
        <div class="social_icon">
            @forelse ($socmeds as $socmed)
            <a href="{{ $socmed->link }}"><i class="fa fa-{{ \Str::lower($socmed->name) }}"></i></a>
            @empty

            @endforelse

        </div>
        <div class="br"></div>
    </aside>
    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title">Popular Posts</h3>
        <div class="media post_item">
            <img src="{{ asset('assets/frontend/img/blog/popular-post/post1.jpg') }}" alt="post">
            <div class="media-body">
                <a href="single-blog.html">
                    <h3>Space The Final Frontier</h3>
                </a>
                <p>02 Hours ago</p>
            </div>
        </div>
        <div class="media post_item">
            <img src="{{ asset('assets/frontend/img/blog/popular-post/post2.jpg') }}" alt="post">
            <div class="media-body">
                <a href="single-blog.html">
                    <h3>The Amazing Hubble</h3>
                </a>
                <p>02 Hours ago</p>
            </div>
        </div>
        <div class="media post_item">
            <img src="{{ asset('assets/frontend/img/blog/popular-post/post3.jpg') }}" alt="post">
            <div class="media-body">
                <a href="single-blog.html">
                    <h3>Astronomy Or Astrology</h3>
                </a>
                <p>03 Hours ago</p>
            </div>
        </div>
        <div class="media post_item">
            <img src="{{ asset('assets/frontend/img/blog/popular-post/post4.jpg') }}" alt="post">
            <div class="media-body">
                <a href="single-blog.html">
                    <h3>Asteroids telescope</h3>
                </a>
                <p>01 Hours ago</p>
            </div>
        </div>
        <div class="br"></div>
    </aside>
    <aside class="single_sidebar_widget ads_widget">
        <a href="#"><img class="img-fluid" src="{{ asset('assets/frontend/img/blog/add.jpg') }}" alt=""></a>
        <div class="br"></div>
    </aside>
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Categories</h4>
        <ul class="list cat-list">
           @forelse ($post_categories as $post_category)
           <li>
            <a href="#" class="d-flex justify-content-between">
                <p>{{ $post_category->name }}</p>
                <p>{{ $post_category->posts_count }}</p>
            </a>
        </li>
           @empty

           @endforelse
        </ul>
        <div class="br"></div>
    </aside>
    <aside class="single-sidebar-widget tag_cloud_widget">
        <h4 class="widget_title">Tag</h4>
        <ul class="list">
           @forelse ($post_tags as $post_tag)
           <li><a href="#">{{ $post_tag->name }}</a></li>
           @empty

           @endforelse
        </ul>
    </aside>
</div>
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
