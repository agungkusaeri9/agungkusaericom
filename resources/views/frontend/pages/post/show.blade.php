@extends('frontend.layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Hero Image -->
                <div class="mb-8">
                    <img src="{{ $post->image() }}" alt="{{ $post->title }}"
                        class="w-full h-64 md:h-96 object-cover rounded-2xl shadow-lg">
                </div>

                <!-- Breadcrumb -->
                <nav class="mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 text-sm">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-gray-500 hover:text-blue-600 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <a href="{{ route('posts.index') }}"
                                    class="text-gray-500 hover:text-blue-600 transition-colors duration-200">Blog</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-400">{{ \Str::limit($post->title, 30) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Article Header -->
                <header class="mb-8">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Article Meta -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 mb-6">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <a href="{{ route('posts.category', $post->category->slug) }}"
                                class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                {{ $post->category->name }}
                            </a>
                        </div>

                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $setting->author }}</span>
                        </div>
                    </div>
                </header>

                <!-- Article Content -->
                <article class="prose prose-lg max-w-none mb-12">
                    <div class="text-gray-700 leading-relaxed">
                        {!! $post->description !!}
                    </div>
                </article>

                <!-- Tags -->
                @if ($post->tags->count() > 0)
                    <div class="mb-12">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag->slug) }}"
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Comments Section -->
                <div class="bg-white rounded-2xl border border-gray-100 p-8 mb-12">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                            {{ count($post->comments) }} Comments
                        </h2>
                        <p class="text-gray-600">Join the discussion and share your thoughts</p>
                    </div>

                    @if ($post->comments->count() > 0)
                        <div class="space-y-8">
                            @foreach ($post->comments as $comment)
                                <div class="border-b border-gray-100 pb-8 last:border-b-0">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $comment->name }}</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $comment->created_at->format('M d, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                        <button
                                            class="text-sm bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition-colors duration-200 btnReplay"
                                            data-commentid="{{ $comment->id }}">
                                            Reply
                                        </button>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">{{ $comment->comment }}</p>

                                    <!-- Child Comments -->
                                    @if ($comment->child->count() > 0)
                                        <div class="mt-6 ml-8 space-y-6">
                                            @foreach ($comment->child as $child)
                                                <div class="border-l-2 border-gray-200 pl-6">
                                                    <div class="mb-3">
                                                        <h5 class="text-base font-semibold text-gray-800">
                                                            {{ $child->name }}</h5>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $child->created_at->format('M d, Y \a\t g:i A') }}
                                                        </p>
                                                    </div>
                                                    <p class="text-gray-700 leading-relaxed">{{ $child->comment }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No comments yet</h3>
                            <p class="text-gray-600">Be the first to share your thoughts!</p>
                        </div>
                    @endif
                </div>

                <!-- Comment Form -->
                <div class="bg-white rounded-2xl border border-gray-100 p-8 mb-12 comment-form">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Leave a Comment</h2>
                        <p class="text-gray-600">Share your thoughts and join the discussion</p>
                    </div>

                    <form action="{{ route('posts.comment') }}" method="post" class="space-y-6">
                        @csrf
                        <input type="number" name="post_id" value="{{ $post->id }}" hidden>
                        <input type="number" name="parent_id" hidden>

                        @if (!request()->session()->has('name'))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name"
                                        class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        placeholder="Your name" value="{{ old('name') }}" />
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        placeholder="your.email@example.com" value="{{ old('email') }}" />
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="text" name="name" value="{{ request()->session()->get('name') }}" hidden>
                            <input type="text" name="email" value="{{ request()->session()->get('email') }}"
                                hidden>
                        @endif

                        <div>
                            <label for="comment" class="block text-sm font-semibold text-gray-700 mb-2">Comment</label>
                            <textarea id="comment" name="comment" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none"
                                placeholder="Share your thoughts..."></textarea>
                            @error('comment')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (!request()->session()->has('name'))
                            <div class="flex items-center">
                                <input id="save_info" name="save_info" type="checkbox" value="1"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="save_info" class="ml-2 text-sm text-gray-700">
                                    Save my name and email for future comments
                                </label>
                            </div>
                        @endif

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="space-y-8">
                    <!-- Author Info -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">About the Author</h3>
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="{{ $setting->author_image() }}" alt="{{ $setting->author }}"
                                class="w-12 h-12 rounded-full">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $setting->author }}</h4>
                                <p class="text-sm text-gray-600">Author</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">{{ $setting->author_description }}</p>
                        </p>
                    </div>

                    <!-- Related Articles -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Related Articles</h3>
                        <div class="space-y-4">

                            @forelse($relatedPosts as $relatedPost)
                                <a href="{{ route('posts.show', $relatedPost->slug) }}" class="block group">
                                    <div class="flex space-x-3">
                                        <img src="{{ $relatedPost->image() }}" alt="{{ $relatedPost->title }}"
                                            class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-sm font-medium text-gray-800 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                                {{ $relatedPost->title }}
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $relatedPost->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">No related articles found.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                        <div class="space-y-2">
                            @php
                                $categories = \App\Models\PostCategory::withCount('posts')->get();
                            @endphp

                            @foreach ($categories as $category)
                                <a href="{{ route('posts.category', $category->slug) }}"
                                    class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <span class="text-sm text-gray-700">{{ $category->name }}</span>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                        {{ $category->posts_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">

                            @foreach ($popularTags as $tag)
                                <a href="{{ route('posts.tag', $tag->slug) }}"
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Stay Updated</h3>
                        <p class="text-sm text-gray-600 mb-4">Get the latest articles and insights delivered to your inbox.
                        </p>
                        <form class="space-y-3">
                            <input type="email" placeholder="Enter your email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        })
    </script>
@endpush
