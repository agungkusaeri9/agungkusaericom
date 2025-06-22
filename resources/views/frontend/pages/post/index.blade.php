@extends('frontend.layouts.app')
@section('content')
    <x-Frontend.SectionTitle title="Blogs"
        description="Discover the latest articles, guides, and tutorials on technology and programming. Gain valuable insights and practical solutions to enhance your coding skills." />

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Search Section -->
        <div class="mb-12">
            <div class="flex justify-center">
                <form class="w-full max-w-2xl" action="{{ route('posts.search') }}">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text"
                            class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200"
                            placeholder="Search articles, tutorials, and guides..." name="q"
                            value="{{ request('q') }}">
                        <button type="submit"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 bg-blue-600 text-white rounded-r-xl px-6 hover:bg-blue-700 transition-colors duration-200">
                            <span class="text-sm font-medium">Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results Header -->
        @if (request('q'))
            <div class="text-center mb-8">
                <div class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-full mb-4">
                    <span class="text-sm font-medium text-blue-700">🔍 Search Results</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Results for "<span class="text-blue-600">{{ request('q') }}</span>"
                </h2>
                <p class="text-gray-600">{{ count($posts) }} articles found</p>
            </div>
        @endif

        @isset($category)
            <div class="text-center mb-8">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full mb-4">
                    <span class="text-sm font-medium text-green-700">📂 Category</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Category: "<span class="text-green-600">{{ $category->name }}</span>"
                </h2>
                <p class="text-gray-600">{{ count($posts) }} articles found</p>
            </div>
        @endisset

        @isset($tag)
            <div class="text-center mb-8">
                <div class="inline-flex items-center px-4 py-2 bg-purple-50 rounded-full mb-4">
                    <span class="text-sm font-medium text-purple-700">🏷️ Tag</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Tag: "<span class="text-purple-600">{{ $tag->name }}</span>"
                </h2>
                <p class="text-gray-600">{{ count($posts) }} articles found</p>
            </div>
        @endisset

        <!-- Blog Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach ($posts as $post)
                <article class="group">
                    <div
                        class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                        <a href="{{ route('posts.show', $post->slug) }}" class="block">
                            <!-- Image Container -->
                            <div class="relative overflow-hidden">
                                <img src="{{ $post->image() }}" alt="{{ $post->title }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <!-- Category Badge -->
                                @if (isset($post->category))
                                    <div class="absolute top-3 left-3">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600 text-white">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3
                                    class="text-lg font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                    {{ $post->title }}
                                </h3>

                                @if ($post->meta_description)
                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                        {{ \Str::limit($post->meta_description, 120) }}
                                    </p>
                                @endif

                                <!-- Read More -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                    <span
                                        class="inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-700 transition-colors duration-200">
                                        Read More
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($posts->hasPages())
            {{ $posts->links('pagination::tailwind') }}
        @endif

        <!-- Empty State -->
        @if (count($posts) === 0)
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No articles found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your search terms or browse all articles</p>
                <a href="{{ route('posts.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Browse All Articles
                </a>
            </div>
        @endif
    </div>
@endsection
