@extends('frontend.layouts.app')
@section('content')
    <div class="w-full py-10">
        <h1 class="text-5xl mb-5 text-center text-gray-800">ABOUT ME</h1>
        <p class="text-center text-gray-600 mb-10">Mewujudkan ide menjadi kenyataan dengan solusi yang tepat</p>

        <div class="flex justify-center items-center mx-auto space-x-10">
            <div class="text-center">
                <img src="{{ $setting->author_image() }}" class="w-70 object-cover shadow-lg" alt="{{ $setting->author }}">
            </div>
            <div class="max-w-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Let's Introduce About Myself</h2>
                <p class="text-justify text-gray-700">{{ $setting->author_description }}</p>
            </div>
        </div>
    </div>
@endsection
