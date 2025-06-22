@extends('frontend.layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm text-gray-500 font-medium hover:text-blue-600 transition-colors duration-200">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('projects.index') }}"
                            class="text-sm text-gray-500 font-medium hover:text-blue-600 transition-colors duration-200">Projects</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm text-gray-400 font-medium">{{ $project->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Project Image -->
                <div class="mb-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <img src="{{ $project->image() }}" alt="{{ $project->name }}" class="w-full h-96 object-cover">
                    </div>
                </div>

                <!-- Project Title and Meta -->
                <div class="mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $project->name }}</h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C20.1752 21.4816 19.3001 21.7706 18 21.8985"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M7 4V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M17 4V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M21.5 9H16.625H10.75M2 9H5.875" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>
                            <span>{{ $project->created_at->diffForHumans() }}</span>
                        </div>

                        @if (isset($project->category))
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.99988 6C7.99988 3.79086 9.79074 2 11.9999 2H16.9999C19.209 2 20.9999 3.79086 20.9999 6V16.0514C20.9999 17.6802 19.157 18.626 17.8337 17.6762L15.9999 16.3601V20.0514C15.9999 21.6802 14.157 22.626 12.8337 21.6762L9.49988 19.2835L6.16603 21.6762C4.84275 22.626 2.99988 21.6802 2.99988 20.0514V10C2.99988 7.79086 4.79074 6 6.99988 6H7.99988ZM9.99988 6C9.99988 4.89543 10.8953 4 11.9999 4H16.9999C18.1044 4 18.9999 4.89543 18.9999 6V16.0514L15.9999 13.8983V10C15.9999 7.79086 14.209 6 11.9999 6H9.99988ZM6.99988 8C5.89531 8 4.99988 8.89543 4.99988 10V20.0514L8.33373 17.6587C9.0307 17.1585 9.96906 17.1585 10.666 17.6587L13.9999 20.0514V10C13.9999 8.89543 13.1044 8 11.9999 8H6.99988Z"
                                        fill="currentColor"></path>
                                </svg>
                                <a href="{{ route('projects.category', $project->category->slug) }}"
                                    class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                    {{ $project->category->name }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Project Description -->
                <div class="mb-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Project Description</h2>
                        <div class="prose prose-gray max-w-none">
                            <p class="text-gray-700 leading-relaxed">{!! $project->description !!}</p>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                @if (count($project->tags) > 0)
                    <div class="mb-8">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Technologies Used</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($project->tags as $tag)
                                    <a href="{{ route('projects.tag', $tag->slug) }}"
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Gallery -->
                @if (count($project->galleries) > 0)
                    <div class="mb-8">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Project Gallery</h2>
                            <div x-data="{
                                imageGalleryOpened: false,
                                imageGalleryActiveUrl: null,
                                imageGalleryImageIndex: null,
                                imageGalleryOpen(event) {
                                    this.imageGalleryImageIndex = event.target.dataset.index;
                                    this.imageGalleryActiveUrl = event.target.src;
                                    this.imageGalleryOpened = true;
                                },
                                imageGalleryClose() {
                                    this.imageGalleryOpened = false;
                                    setTimeout(() => this.imageGalleryActiveUrl = null, 300);
                                },
                                imageGalleryNext() {
                                    if (this.imageGalleryImageIndex == this.$refs.gallery.childElementCount) {
                                        this.imageGalleryImageIndex = 1;
                                    } else {
                                        this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) + 1;
                                    }
                                    this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
                                },
                                imageGalleryPrev() {
                                    if (this.imageGalleryImageIndex == 1) {
                                        this.imageGalleryImageIndex = this.$refs.gallery.childElementCount;
                                    } else {
                                        this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) - 1;
                                    }
                                    this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
                                }
                            }" @image-gallery-next.window="imageGalleryNext()"
                                @image-gallery-prev.window="imageGalleryPrev()" @keyup.right.window="imageGalleryNext();"
                                @keyup.left.window="imageGalleryPrev();" x-init="imageGalleryPhotos = $refs.gallery.querySelectorAll('img');
                                for (let i = 0; i < imageGalleryPhotos.length; i++) {
                                    imageGalleryPhotos[i].setAttribute('data-index', i + 1);
                                }"
                                class="w-full h-full select-none">

                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach ($project->galleries as $gallery)
                                        <div class="group cursor-pointer">
                                            <img x-on:click="imageGalleryOpen" src="{{ $gallery->image() }}"
                                                class="w-full h-32 object-cover rounded-lg border border-gray-200 group-hover:scale-105 transition-transform duration-200"
                                                alt="{{ $project->name }}">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Lightbox Modal -->
                                <template x-teleport="body">
                                    <div x-show="imageGalleryOpened"
                                        x-transition:enter="transition ease-in-out duration-300"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:leave="transition ease-in-in duration-300"
                                        x-transition:leave-end="opacity-0" @click="imageGalleryClose"
                                        @keydown.window.escape="imageGalleryClose"
                                        x-trap.inert.noscroll="imageGalleryOpened"
                                        class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-75 select-none cursor-zoom-out"
                                        x-cloak>
                                        <div class="relative flex items-center justify-center w-11/12 xl:w-4/5 h-11/12">
                                            <div @click="$event.stopPropagation(); $dispatch('image-gallery-prev')"
                                                class="absolute left-4 flex items-center justify-center text-white rounded-full cursor-pointer bg-white/10 w-12 h-12 hover:bg-white/20 transition-colors duration-200">
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                            </div>
                                            <img x-show="imageGalleryOpened"
                                                x-transition:enter="transition ease-in-out duration-300"
                                                x-transition:enter-start="opacity-0 transform scale-50"
                                                x-transition:leave="transition ease-in-in duration-300"
                                                x-transition:leave-end="opacity-0 transform scale-50"
                                                class="object-contain object-center w-full h-full select-none cursor-zoom-out"
                                                :src="imageGalleryActiveUrl" alt="" style="display: none;">
                                            <div @click="$event.stopPropagation(); $dispatch('image-gallery-next');"
                                                class="absolute right-4 flex items-center justify-center text-white rounded-full cursor-pointer bg-white/10 w-12 h-12 hover:bg-white/20 transition-colors duration-200">
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="space-y-6">
                    <!-- Project Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Project Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm text-gray-600">Created
                                    {{ $project->created_at->format('M d, Y') }}</span>
                            </div>

                            @if (isset($project->category))
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Category: <a
                                            href="{{ route('projects.category', $project->category->slug) }}"
                                            class="text-blue-600 hover:text-blue-700">{{ $project->category->name }}</a></span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Related Projects -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Related Projects</h3>
                        <div class="space-y-4">
                            @php
                                $relatedProjects = \App\Models\Project::where('id', '!=', $project->id)
                                    ->where('project_category_id', $project->project_category_id)
                                    ->limit(3)
                                    ->get();
                            @endphp

                            @if (count($relatedProjects) > 0)
                                @foreach ($relatedProjects as $relatedProject)
                                    <a href="{{ route('projects.show', $relatedProject->slug) }}" class="block group">
                                        <div
                                            class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $relatedProject->image() }}"
                                                    alt="{{ $relatedProject->name }}"
                                                    class="w-16 h-16 object-cover rounded-lg">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="text-sm font-medium text-gray-800 group-hover:text-blue-600 transition-colors duration-200 truncate">
                                                    {{ $relatedProject->name }}
                                                </h4>
                                                @if ($relatedProject->meta_description)
                                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                                        {{ \Str::limit($relatedProject->meta_description, 80) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-500">No related projects found</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Browse Categories</h3>
                        <div class="space-y-2">
                            @foreach (\App\Models\ProjectCategory::withCount('projects')->get() as $category)
                                <a href="{{ route('projects.category', $category->slug) }}"
                                    class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <span class="text-sm text-gray-700">{{ $category->name }}</span>
                                    <span
                                        class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $category->projects_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    @if (count($project->tags) > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Popular Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($project->tags->take(10) as $tag)
                                    <a href="{{ route('projects.tag', $tag->slug) }}"
                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-Frontend.Alert />
@endsection

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
