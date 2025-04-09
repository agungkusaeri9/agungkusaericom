@extends('frontend.layouts.app')
@section('content')
    <x-Frontend.SectionTitle title="About Me"
        description=" Welcome to our About page! Discover our mission, values, and commitment to delivering quality tech
solutions that drive success and innovation." />

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


    <div class="md:mb-20">
        <div class="grid grid-cols-1 md:grid-cols-[50%] mx-auto mt-10 md:mb-12 mb-8 text-center justify-center ">
            <h2 class="text-xl mb-5 md:mb-5 font-semibold md:text-3xl">Skills</h2>
            <p class="text-sm text-slate-700 md:text-base">
                A collection of professional skills developed through experience and learning, focusing on
                delivering high-quality results and innovative solutions.
            </p>
        </div>
        <div class="flex justify-center">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-5 md:gap-24 max-w-[1000px]">
                @foreach ($skills as $skil)
                    <div>
                        <img class="object-cover h-20 aspect-square md:h-20 rounded-sm hover:brightness-50"
                            src="{{ $skil->image() }}" alt="Skill {{ $skil->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="md:mb-20">
        <div class="grid grid-cols-1 md:grid-cols-[50%] mx-auto mt-10 md:mb-12 mb-8 text-center justify-center">
            <h2 class="text-xl mb-5 md:mb-5 font-semibold md:text-3xl">Tools</h2>
            <p class="text-sm text-slate-700 md:text-base">
                A selection of essential tools used to enhance productivity, streamline workflows, and achieve
                efficient,
                high-quality results in various projects.
            </p>
        </div>
        <div class="flex justify-center">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-5 md:gap-24 max-w-[1000px]">
                @foreach ($tools as $tool)
                    <div>
                        <img class="object-cover h-20 aspect-square md:h-20 rounded-sm hover:brightness-50"
                            src="{{ $tool->image() }}" alt="{{ $tool->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
