@extends('frontend.layouts.app')
@section('content')
    <div class="grid grid-cols-1">
        <div class="px-4 mt-5">
            <div class="flex justify-center">
                <div class="w-full md:w-1/2 md:mb-10 text-center">
                    <h1 class="text-4xl font-bold mb-3 text-slate-800">Projects</h1>
                    <p class="text-sm mb-5">Explore a collection of recent projects, in-depth guides, and tutorials focused
                        on technology and programming. Gain valuable insights and practical solutions to boost your coding
                        skills and knowledge.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-2">
        <div class="px-4">
            <div class="md:flex md:justify-end">
                <form class="w-full  mb-4 md:w-[520px]" action="{{ route('projects.search') }}">
                    <div class="relative">
                        <input type="text"
                            class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Search keyword project..." name="q" value="{{ request('q') }}">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5a7 7 0 100 14 7 7 0 000-14zM21 21l-4.35-4.35" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            @if (request('q'))
                <p class="text-slate-800 mb-3 text-center md:my-10">Search Results for "<span
                        class="font-semibold">{{ request('q') }}</span>"
                    Displaying
                    {{ count($projects) }} projects</p>
            @endif
            @isset($category)
                <p class="text-slate-800 mb-3 text-center md:my-10">Results for category "<span
                        class="font-semibold">{{ $category->name }}</span>"
                    Displaying
                    {{ count($projects) }} projects</p>
            @endisset
            @isset($tag)
                <p class="text-slate-800 mb-3 text-center md:my-10">Results for tag "<span
                        class="font-semibold">{{ $tag->name }}</span>"
                    Displaying
                    {{ count($projects) }} projects</p>
            @endisset
            <div class="grid grid-cols-1 md:grid-cols-4 md:gap-6">
                @foreach ($projects as $project)
                    <x-Frontend.CardProject id="{{ $project->id }}" />
                @endforeach
            </div>
            <div class="">
                {{ $projects->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
