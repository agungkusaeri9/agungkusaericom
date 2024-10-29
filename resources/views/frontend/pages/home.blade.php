@extends('frontend.layouts.app')
@section('content')
    <div class="px-4">

        {{-- hero --}}
        <div class="md:justify-between md:items-center min-h-screen flex justify-center items-center">
            <div class="md:text-left">
                <h3 class="text-xl font-semibold mb-5 uppercase md:text-2xl md:mb-5">Hello</h3>
                <h1 class="text-6xl font-semibold mb-5 uppercase md:text-8xl md:mb-5">I am Agung <span
                        class="md:block">Kusaeri</span>
                </h1>
                <h2 class="text-xl uppercase md:text-xl font-semibold">Software Developer</h2>
                <div class="mt-5 md:mt-8">
                    <a href="mailto:{{ $setting->email }}"
                        class="bg-red-600 hover:border hover:border-red-600 hover:bg-transparent hover:text-slate-800 text-white text-sm px-3 py-2 rounded-lg md:text-[15px] md:px-10 md:py-3">Hire
                        Me</a>
                    <a href="{{ route('download.cv') }}"
                        class="border border-red-600 text-slate-800 text-sm px-3 py-2 rounded-lg hover:bg-red-600 hover:text-white md:text-[15px] md:px-10 md:py-3">Get
                        CV</a>
                </div>
            </div>

            <div class="md:flex md:justify-end hidden">
                <img src="{{ asset('assets/frontend/img/banner/home-right.png') }}" class="w-120" alt="">
            </div>
        </div>

        {{-- about me --}}
        <div class="md:mb-20">
            <div class="grid grid-cols-1 md:w-[100%] px-4  md:grid-cols-[40%_60%] md:gap-10">
                <div class="flex justify-center mb-5 md:w-90 items-center">
                    <img src="{{ $setting->author_image() }}"
                        class="w-[150px] h-[150px] md:w-[350px] md:h-[350px] rounded-full object-cover shadow-lg"
                        alt="{{ $setting->author }}">
                </div>
                <div class="md:mt-10">
                    <h2 class="text-xl text-center md:text-left md:text-3xl font-bold text-gray-800 mb-5 md:mb-10">Let's
                        Introduce
                        About
                        Myself</h2>
                    <p class="text-justify text-sm text-slate-700 md:text-xl">{{ $setting->author_description }}</p>
                </div>
            </div>
        </div>

        {{-- skills --}}
        <div class="md:mb-20">
            <div class="grid grid-cols-1 md:grid-cols-[50%] mx-auto mt-10 md:mb-12 mb-8 text-center justify-center ">
                <h2 class="text-xl mb-5 md:mb-5 font-semibold md:text-3xl">Skills</h2>
                <p class="text-sm text-slate-700 md:text-base">
                    A collection of professional skills developed through experience and learning, focusing on
                    delivering high-quality results and innovative solutions.
                </p>
            </div>
            <div class="flex justify-center gap-5 md:gap-24">
                @foreach ($skills as $skil)
                    <div>
                        <img class="object-cover h-20 aspect-square md:h-40 rounded-sm hover:brightness-50"
                            src="{{ $skil->image() }}" alt="Skill {{ $skil->name }}">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- tools --}}
        <div class="md:mb-20">
            <div class="grid grid-cols-1 md:grid-cols-[50%] mx-auto mt-10 md:mb-12 mb-8 text-center justify-center">
                <h2 class="text-xl mb-5 md:mb-5 font-semibold md:text-3xl">Tools</h2>
                <p class="text-sm text-slate-700 md:text-base">
                    A selection of essential tools used to enhance productivity, streamline workflows, and achieve
                    efficient,
                    high-quality results in various projects.
                </p>
            </div>
            <div class="flex justify-center gap-5 md:gap-24 mb-5">
                <div class="">
                    <img class="object-cover aspect-square h-20 md:h-40 rounded-sm opacity-100 hover:brightness-50"
                        src="{{ asset('assets/frontend/img/linux-svgrepo-com.svg') }}" alt="Linux">
                </div>
                <div class="">
                    <img class="object-cover aspect-square h-20 md:h-40 rounded-sm opacity-100 hover:brightness-50"
                        src="{{ asset('assets/frontend/img/visual-studio-code-svgrepo-com.svg') }}"
                        alt="Visual Studio Code">
                </div>
                <div class="">
                    <img class="object-cover aspect-square h-20 md:h-40 rounded-sm opacity-100 hover:brightness-50"
                        src="{{ asset('assets/frontend/img/git-svgrepo-com.svg') }}" alt="Git">
                </div>
                <div class="">
                    <img class="object-cover aspect-square h-20 md:h-40 rounded-sm opacity-100 hover:brightness-50"
                        src="{{ asset('assets/frontend/img/postman-icon-svgrepo-com.svg') }}" alt="Postman">
                </div>
            </div>
        </div>

        {{-- latest project --}}
        <div class="md:mb-20">
            <div class="grid grid-cols-1 md:grid-cols-[50%] mx-auto mt-10 md:mb-12 mb-8 text-center justify-center ">
                <h2 class="text-xl mb-5 md:mb-5 font-semibold md:text-3xl">Latest Project</h2>
                <p class="text-sm text-slate-700 md:text-base">
                    An overview of recent projects showcasing innovative solutions, technical expertise, and a
                    commitment to quality across various domains.
                </p>
            </div>
            <x-Frontend.LatestProject />
        </div>
        <div>
            <div class="grid grid-cols-1 md:grid-cols-[50%] mx-auto mt-10 md:mb-12 mb-8 text-center justify-center ">
                <h2 class="text-xl mb-5 md:mb-5 font-semibold md:text-3xl">Latest Posts</h2>
                <p class="text-sm text-slate-700 md:text-base">
                    An overview of recent projects showcasing innovative solutions, technical expertise, and a
                    commitment to quality across various domains.
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach ($latest_posts as $lp)
                    <div class="bg-white mb-5 rounded-md">
                        <a href="{{ route('posts.show', $lp->slug) }}">
                            <img src="{{ $lp->image() }}" alt=""
                                class="aspect-video h-35 rounded-t-md  md:h-50 object-cover hover:brightness-50">
                            <div class="pt-2 px-1">
                                <h1 class="text-sm font-semibold text-slate-800 mb-2">{{ $lp->title }}</h1>
                                <div class="mb-2">
                                    <a href="{{ route('posts.category', $lp->category->slug) }}"
                                        class="bg-slate-600 rounded-md text-white text-xs p-1">{{ $lp->category->name }}</a>
                                </div>
                                <p class="text-slate-700 text-justify text-xs">
                                    {{ \Str::limit($lp->meta_description, 200) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
