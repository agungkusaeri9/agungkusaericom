@extends('frontend.layouts.app')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-[60%] px-4 md:mt-10 justify-center">
        <div>
            <div>
                <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="w-full object-cover mt-3">
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
                            <a href="{{ route('posts.index') }}"
                                class="ms-1 text-xs md:text-sm text-slate-500 font-medium hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Blog</a>
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
                                class="ms-1 text-xs md:text-sm text-slate-400 font-medium md:ms-2 dark:text-gray-400">{{ $post->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl my-6 font-semibold md:text-4xl">{{ $post->title }}</h1>
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
                        <span class="text-xs text-slate-600">{{ $post->created_at->diffForHumans() }}</span>
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
                            <a href="{{ route('posts.category', $post->category->slug) }}">{{ $post->category->name }}</a>
                        </span>
                    </div>
                    <div class="flex gap-1 mb-3">
                        <svg class="h-4 text-slate-400" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <circle cx="12" cy="6" r="4" stroke="#1C274C" stroke-width="1.5"></circle>
                                <path
                                    d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                        <span class="text-xs text-slate-600">{{ $post->user->name }}
                        </span>
                    </div>
                </div>
                <div class="post-description leading-9">
                    <p class="text-sm">{!! $post->description !!}</p>
                </div>

                {{-- tags --}}
                <div class="md:mt-4">
                    <h2 class="text-base font-semibold mb-2">Tags :</h2>
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('posts.tag', $tag->slug) }}"
                            class="bg-gray-700 rounded-sm text-sm p-2 text-white">{{ $tag->name }}</a>
                    @endforeach
                </div>

                {{-- komentar --}}
                <div class="border mt-10 pt-10 pb-10">
                    <h1 class="text-xl text-center font-semibold md:text-3xl mb-10">
                        <span>{{ count($post->comments) }}</span> Comments
                    </h1>
                    @forelse ($post->comments as $comment)
                        <div class="flex justify-between px-10 mt-10">
                            <div>
                                <h2 class="text-sm font-semibold md:text-xl">{{ $comment->name }}</h2>
                                <p class="text-xs font-light mt-1 text-slate-500">
                                    {{ $comment->created_at->translatedFormat('l, d F Y H:i') }}</p>
                            </div>
                            <div>
                                <button class="text-xs bg-gray-400 text-white p-1 rounded-sm md:text-sm btnReplay"
                                    href="javascript:void(0)" data-commentid="{{ $comment->id }}">Replay</button>
                            </div>
                        </div>
                        <p class="text-sm px-10 mt-3 text-slate-800 text-justify md:text-base">
                            {{ $comment->comment }}
                        </p>
                        @foreach ($comment->child as $child)
                            <div class="ml-20">
                                <div class="flex justify-between px-10 mt-10">
                                    <div>
                                        <h2 class="text-sm font-semibold md:text-xl">{{ $child->name }}</h2>
                                        <p class="text-xs font-light mt-1 text-slate-500">
                                            {{ $child->created_at->translatedFormat('l, d F Y H:i') }}</p>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                                <p class="text-sm px-10 mt-3 text-slate-800 text-justify md:text-base">
                                    {{ $child->comment }}
                                </p>
                            </div>
                        @endforeach
                    @empty
                        <p class="text-center mt-10">No Comment!</p>
                    @endforelse
                </div>

                {{-- form comment --}}
                <div class="border mt-5 p-5 rounded-sm md:p-10 comment-form">
                    <h1 class="text-xl text-center font-semibold md:text-3xl mb-10"><span>Leave a Replay</h1>
                    <form action="{{ route('posts.comment') }}" method="post">
                        @csrf
                        <input type="number" name="post_id" value="{{ $post->id }}" hidden>
                        <input type="number" name="parent_id" hidden>
                        @if (request()->session()->has('name'))
                            <input type="text" name="name" value="{{ request()->session()->get('name') }}" hidden>
                        @else
                            <div class="mb-5">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                    placeholder="Name" name="name" value="{{ old('name') }}" />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        @endif

                        @if (request()->session()->has('email'))
                            <input type="text" name="email" value="{{ request()->session()->get('email') }}"
                                hidden>
                        @else
                            <div class="mb-5">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                    placeholder="Email" name="email" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-5">
                            <label for="comment"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment</label>
                            <textarea id="comment" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Leave a comment..." name="comment"></textarea>
                            @error('comment')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        @if (!request()->session()->has('name'))
                            <div class="mb-5">
                                <div class="flex items-center mb-4">
                                    <input id="save_info" name="save_info" type="checkbox" value="1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="save_info"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Store name and
                                        email
                                        information</label>
                                </div>
                            </div>
                        @endif
                        <div class="mb-5">
                            <button class="bg-red-700 text-white text-sm p-2 rounded-sm">Post Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- latest articles --}}
        <div class="mt-10">
            <h1 class="text-xl font-semibold my-5 md:text-2xl">Latest Articles</h1>
            <x-Frontend.LatestPost />
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
            // $('.post-description img').addClass('img-fluid');
        })
    </script>
@endpush
