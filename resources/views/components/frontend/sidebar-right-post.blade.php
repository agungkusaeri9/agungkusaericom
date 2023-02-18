<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
       <form action="{{ route('posts.search') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Posts" name="q" value="{{ request('q') }}">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i
                        class="lnr lnr-magnifier"></i></button>
            </span>
        </div><!-- /input-group -->
       </form>
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
       @forelse ($popular_posts as $popular)
       <div class="media post_item">
        <img src="{{ $popular->image() }}" alt="post" class="img-popular">
        <div class="media-body">
            <a href="{{ route('posts.show',$popular->slug) }}">
                <h3>{{ $popular->title }}</h3>
            </a>
            <p>{{ $popular->created_at->diffForHumans() }}</p>
        </div>
    </div>
       @empty

       @endforelse
        <div class="br"></div>
    </aside>
    {{-- iklan --}}
    {{-- <aside class="single_sidebar_widget ads_widget">
        <a href="#"><img class="img-fluid" src="{{ asset('assets/frontend/img/blog/add.jpg') }}" alt=""></a>
        <div class="br"></div>
    </aside> --}}
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Categories</h4>
        <ul class="list cat-list">
           @forelse ($post_categories as $post_category)
           <li>
            <a href="{{ route('posts.category',$post_category->slug) }}" class="d-flex justify-content-between">
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
           <li><a href="{{ route('posts.tag',$post_tag->slug) }}">{{ $post_tag->name }}</a></li>
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
            background-image: url('{{ $setting->author_image() }}');
            background-position:center;
            background-size: 200px;
            border-radius:50%;
            text-align: center;
        }
        .img-popular{
            max-height: 60px;
        }
    </style>
@endpush
