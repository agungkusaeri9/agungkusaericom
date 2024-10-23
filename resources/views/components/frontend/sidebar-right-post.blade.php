<div class="blog_right_sidebar">
    <aside>
        <form action="{{ route('posts.search') }}" method="get">
            <label class="input input-bordered flex items-center gap-2 mb-6">
                <input type="text" class="grow" placeholder="Cari Judul Artikel" name="q"
                    value="{{ old('q') }}" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        <div class="br"></div>
    </aside>
    <aside class="single_sidebar_widget author_widget border p-5 shadow-sm rounded-md">
        <div class="flex justify-center">
            <div class="kotak-gambar"></div>
        </div>
        <h2 class="text-2xl text-center my-5">{{ $setting->author }}</h2>
        <p class="text-justify">{{ $setting->author_description }}</p>
        <div class="social_icon">
            @forelse ($socmeds as $socmed)
                <a href="{{ $socmed->link }}"><i class="fa fa-{{ \Str::lower($socmed->name) }}"></i></a>
            @empty
            @endforelse
        </div>
        <div class="br"></div>
    </aside>
    <aside class="border p-5 mt-5 rounded-md shadow-sm">
        <h3 class="text-2xl font-semibold mb-10">Popular Posts</h3>
        @forelse ($popular_posts as $popular)
            <div class="flex mb-5">
                <img src="{{ $popular->image() }}" class="h-20 w-20" alt="">
                <div class="ml-5">
                    <h3>
                        <a href="{{ route('posts.show', $popular->slug) }}">{{ $popular->title }}</a>
                    </h3>
                    <p class="text-small">{{ $popular->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
        @endforelse
    </aside>
    <aside class="border p-5 mt-5 mb-5 rounded-md shadow-sm">
        <h3 class="text-2xl font-semibold mb-10">Categories</h3>
        <ul class="list cat-list">
            @forelse ($post_categories as $post_category)
                <li>
                    <a href="{{ route('posts.category', $post_category->slug) }}" class="flex mb-5 justify-between">
                        <p>{{ $post_category->name }}</p>
                        <p>{{ $post_category->posts_count }}</p>
                    </a>
                </li>
            @empty
            @endforelse
        </ul>
    </aside>
    <aside class="border p-5 rounded-md shadow-sm">
        <h4 class="text-2xl font-semibold mb-10">Tag</h4>
        <ul class="list">
            @forelse ($post_tags as $post_tag)
                {{-- <li><a href="{{ route('posts.tag', $post_tag->slug) }}">{{ $post_tag->name }}</a></li> --}}
                <li>
                    <a href="{{ route('posts.tag', $post_tag->slug) }}" class="flex mb-5 justify-between">
                        <p>{{ $post_tag->name }}</p>
                        <p>{{ $post_tag->posts_count }}</p>
                    </a>
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
