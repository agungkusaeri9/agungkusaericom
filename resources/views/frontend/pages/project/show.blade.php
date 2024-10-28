@extends('frontend.layouts.app')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-[60%] px-4 mt-5 justify-center">
        <div>
            <div>
                <img src="{{ $project->image() }}" alt="{{ $project->name }}" class="w-full object-cover mt-3">
            </div>
            <nav class="flex mt-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-xs md:text-sm text-slate-500 font-medium hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('projects.index') }}"
                                class="ms-1 text-xs md:text-sm text-slate-500 font-medium hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Projects</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ms-1 text-xs md:text-sm text-slate-400 font-medium md:ms-2 dark:text-gray-400">{{ $project->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl my-6 font-semibold md:text-4xl">{{ $project->name }}</h1>
            <div class="my-4  text-slate-700">
                <div class="flex flex-wrapper gap-3">
                    <div class="flex gap-1">
                        <svg class="h-4 text-slate-400" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C20.1752 21.4816 19.3001 21.7706 18 21.8985"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M7 4V2.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M17 4V2.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M21.5 9H16.625H10.75M2 9H5.875" stroke="#1C274C" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                                <path
                                    d="M18 17C18 17.5523 17.5523 18 17 18C16.4477 18 16 17.5523 16 17C16 16.4477 16.4477 16 17 16C17.5523 16 18 16.4477 18 17Z"
                                    fill="#1C274C"></path>
                                <path
                                    d="M18 13C18 13.5523 17.5523 14 17 14C16.4477 14 16 13.5523 16 13C16 12.4477 16.4477 12 17 12C17.5523 12 18 12.4477 18 13Z"
                                    fill="#1C274C"></path>
                                <path
                                    d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17Z"
                                    fill="#1C274C"></path>
                                <path
                                    d="M13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13Z"
                                    fill="#1C274C"></path>
                                <path
                                    d="M8 17C8 17.5523 7.55228 18 7 18C6.44772 18 6 17.5523 6 17C6 16.4477 6.44772 16 7 16C7.55228 16 8 16.4477 8 17Z"
                                    fill="#1C274C"></path>
                                <path
                                    d="M8 13C8 13.5523 7.55228 14 7 14C6.44772 14 6 13.5523 6 13C6 12.4477 6.44772 12 7 12C7.55228 12 8 12.4477 8 13Z"
                                    fill="#1C274C"></path>
                            </g>
                        </svg>
                        <span class="text-xs text-slate-600">{{ $project->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex gap-1 mb-3">
                        <svg class="h-4 text-slate-400" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.99988 6C7.99988 3.79086 9.79074 2 11.9999 2H16.9999C19.209 2 20.9999 3.79086 20.9999 6V16.0514C20.9999 17.6802 19.157 18.626 17.8337 17.6762L15.9999 16.3601V20.0514C15.9999 21.6802 14.157 22.626 12.8337 21.6762L9.49988 19.2835L6.16603 21.6762C4.84275 22.626 2.99988 21.6802 2.99988 20.0514V10C2.99988 7.79086 4.79074 6 6.99988 6H7.99988ZM9.99988 6C9.99988 4.89543 10.8953 4 11.9999 4H16.9999C18.1044 4 18.9999 4.89543 18.9999 6V16.0514L15.9999 13.8983V10C15.9999 7.79086 14.209 6 11.9999 6H9.99988ZM6.99988 8C5.89531 8 4.99988 8.89543 4.99988 10V20.0514L8.33373 17.6587C9.0307 17.1585 9.96906 17.1585 10.666 17.6587L13.9999 20.0514V10C13.9999 8.89543 13.1044 8 11.9999 8H6.99988Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                        <span class="text-xs text-slate-600">
                            <a
                                href="{{ route('projects.category', $project->category->slug) }}">{{ $project->category->name }}</a>
                        </span>
                    </div>
                </div>
                <div class="post-description leading-9">
                    <p class="text-sm">{!! $project->description !!}</p>
                </div>

                {{-- tags --}}
                <div class="md:mt-4">
                    <h2 class="text-base font-semibold mb-2">Tags :</h2>
                    @foreach ($project->tags as $tag)
                        <a href="{{ route('projects.tag', $tag->slug) }}"
                            class="bg-gray-700 rounded-sm text-sm p-2 text-white">{{ $tag->name }}</a>
                    @endforeach
                </div>

                {{-- gallery --}}
                <div class="mt-5">
                    <h1 class="text-xl font-semibold mb-4">Gallery</h1>
                    @if (count($project->galleries))
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
                            <div class="max-w-6xl mx-auto duration-1000 delay-300 opacity-0 select-none ease animate-fade-in-view"
                                style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                <ul x-ref="gallery" id="gallery" class="grid grid-cols-2 gap-5 lg:grid-cols-5">

                                    @foreach ($project->galleries as $gallery)
                                        {{-- <img src="{{ $gallery->image() }}" alt="{{ $project->name }}"
                                         class="border w-100 cursor-pointer opacity-75 hover:opacity-100"> --}}
                                        <li><img x-on:click="imageGalleryOpen" src="{{ $gallery->image() }}"
                                                class="object-cover select-none w-full h-20 bg-gray-200 rounded  aspect-[5/6] lg:aspect-[2/3] cursor-pointer border xl:aspect-[3/4]"
                                                alt="{{ $project->name }}"></li>
                                    @endforeach


                                </ul>
                            </div>
                            <template x-teleport="body">
                                <div x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:leave="transition ease-in-in duration-300"
                                    x-transition:leave-end="opacity-0" @click="imageGalleryClose"
                                    @keydown.window.escape="imageGalleryClose" x-trap.inert.noscroll="imageGalleryOpened"
                                    class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-50 select-none cursor-zoom-out"
                                    x-cloak>
                                    <div class="relative flex items-center justify-center w-11/12 xl:w-4/5 h-11/12">
                                        <div @click="$event.stopPropagation(); $dispatch('image-gallery-prev')"
                                            class="absolute left-0 flex items-center justify-center text-white translate-x-10 rounded-full cursor-pointer xl:-translate-x-24 2xl:-translate-x-32 bg-white/10 w-14 h-14 hover:bg-white/20">
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
                                            class="absolute right-0 flex items-center justify-center text-white -translate-x-10 rounded-full cursor-pointer xl:translate-x-24 2xl:translate-x-32 bg-white/10 w-14 h-14 hover:bg-white/20">
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
                    @else
                        <p class="text-center text-sm">
                            Not Found!
                        </p>
                    @endif
                </div>
            </div>

        </div>
        {{-- related projects --}}
        <div class="mt-10">
            <h1 class="text-xl font-semibold my-5">Related Project</h1>
            <x-Frontend.RelatedProject id="{{ $project->id }}" />
        </div>
    </div>
    <x-Frontend.Alert />
@endsection
@push('styles')
    <style>
        .post-description {
            line-height: 30px !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
