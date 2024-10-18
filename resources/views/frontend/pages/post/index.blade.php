@extends('frontend.layouts.app')
@section('content')
    <div class="w-full py-10">
        <h1 class="text-5xl mb-5 text-center text-gray-800">Blog</h1>
        <p class="text-center text-gray-600 mb-10">Mewujudkan ide menjadi kenyataan dengan solusi yang tepat</p>

        <div class="grid lg:grid-cols-4">
            @forelse ($posts as $post)
                <div class="mb-10">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <div class="card bg-base-100 w-96 shadow-sm">
                            <figure>
                                <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="h-60" />
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ $post->title }}
                                </h2>
                                <p class="text-justify my-2">{{ \Str::limit($post->meta_description, 140) }}</p>
                                <div class="card-actions justify-end">
                                    <a href="">
                                        <div class="badge badge-outline">{{ $post->category->name }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            @empty
            @endforelse
        </div>
        <div>
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
