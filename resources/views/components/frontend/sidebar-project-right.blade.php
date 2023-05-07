<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <form action="{{ route('projects.search') }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" value="{{ request('q') }}" name="q"
                    placeholder="Search Projects">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
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
    {{-- iklan --}}
    {{-- <aside class="single_sidebar_widget ads_widget">
        <a href="#"><img class="img-fluid" src="{{ asset('assets/frontend/img/blog/add.jpg') }}" alt=""></a>
        <div class="br"></div>
    </aside> --}}
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Categories</h4>
        <ul class="list cat-list">
            @if (Route::currentRouteName() === 'projects.index' || Route::currentRouteName() === 'projects.show')
                @forelse ($project_categories as $project_category)
                    <li>
                        <a href="{{ route('projects.category', $project_category->slug) }}"
                            class="d-flex justify-content-between">
                            <p>{{ $project_category->name }}</p>
                            <p>{{ $project_category->projects_count }}</p>
                        </a>
                    </li>
                @empty
                @endforelse
            @else
                @forelse ($project_categories_portfolio as $project_category)
                    <li>
                        <a href="{{ route('portofolio.category', $project_category->slug) }}"
                            class="d-flex justify-content-between">
                            <p>{{ $project_category->name }}</p>
                            <p>{{ $project_category->projects_count }}</p>
                        </a>
                    </li>
                @empty
                @endforelse
            @endif
        </ul>
        <div class="br"></div>
    </aside>
    <aside class="single-sidebar-widget tag_cloud_widget">
        <h4 class="widget_title">Tag</h4>
        <ul class="list">
            @forelse ($project_tags as $project_tag)
                <li>
                    @if (Route::currentRouteName() === 'projects.index' || Route::currentRouteName() === 'projects.show')
                        <a href="{{ route('projects.tag', $project_tag->slug) }}">{{ $project_tag->name }}</a>
                    @else
                        <a href="{{ route('portofolio.tag', $project_tag->slug) }}">{{ $project_tag->name }}</a>
                    @endif

                </li>
            @empty
            @endforelse
        </ul>
    </aside>
</div>
@push('styles')
    <style>
        .kotak-gambar {
            height: 200px;
            width: 200px;
            background-image: url('{{ $setting->author_image() }}');
            background-position: center;
            background-size: 200px;
            border-radius: 50%;
            text-align: center;
        }
    </style>
@endpush
