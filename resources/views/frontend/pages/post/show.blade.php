@extends('frontend.layouts.app')
@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div class="sm:col-span-12 md:col-span-8">
            <div class="breadcrumbs text-sm flex justify-center mb-10">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('posts.index') }}">Blog</a></li>
                    <li>{{ $post->title }}</li>
                </ul>
            </div>
            <img src="{{ $post->image() }}" class="w-full" alt="{{ $post->title }}">
            <h1 class="text-4xl mt-4 mb-5">{{ $post->title }}</h1>
            <p>{!! $post->description !!}</p>
        </div>
        <div class="sm:col-span-12 md:col-span-4">
            <x-frontend.SidebarRightPost />
        </div>
    </div>
@endsection
