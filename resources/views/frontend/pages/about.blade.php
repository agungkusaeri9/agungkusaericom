@extends('frontend.layouts.app')
@section('content')
    <x-Frontend.SectionTitle title="About Me"
        description="Welcome to our About page! Discover our mission, values, and commitment to delivering quality tech
solutions that drive success and innovation." />

    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Profile Image -->
            <div class="flex justify-center lg:justify-start">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full blur-lg opacity-10">
                    </div>
                    <img src="{{ $setting->author_image() }}"
                        class="relative w-64 h-64 lg:w-80 lg:h-80 rounded-full object-cover shadow-lg border-2 border-gray-100"
                        alt="{{ $setting->author }}">
                </div>
            </div>

            <!-- About Content -->
            <div class="space-y-6">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-full">
                    <span class="text-sm font-medium text-blue-700">👋 Hello, I'm {{ $setting->author }}</span>
                </div>

                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 leading-tight">
                    Let's Introduce About Myself
                </h2>

                <div class="prose prose-lg text-gray-600 leading-relaxed">
                    <p class="text-justify">{{ $setting->author_description }}</p>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 gap-4 pt-6">
                    <div class="text-center p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="text-2xl font-bold text-blue-600">{{ $setting->year_experience }}+</div>
                        <div class="text-sm text-gray-600">Years Experience</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="text-2xl font-bold text-green-600">{{ $setting->project_completed }}+</div>
                        <div class="text-sm text-gray-600">Projects Completed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Section -->
    <div class="bg-gradient-to-br from-gray-50 to-blue-50 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-white rounded-full shadow-sm mb-4">
                    <span class="text-sm font-medium text-gray-700">🛠️ Professional Skills</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Skills & Expertise</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    A collection of professional skills developed through experience and learning, focusing on
                    delivering high-quality results and innovative solutions.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 max-w-5xl mx-auto">
                @foreach ($skills as $skil)
                    <div class="group">
                        <div
                            class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                            <img class="w-full h-16 object-contain group-hover:scale-110 transition-transform duration-300"
                                src="{{ $skil->image() }}" alt="Skill {{ $skil->name }}">
                            <p class="text-center text-sm font-medium text-gray-700 mt-3">{{ $skil->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Tools Section -->
    <div class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-50 to-emerald-50 rounded-full mb-4">
                    <span class="text-sm font-medium text-green-700">⚙️ Development Tools</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Tools & Technologies</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    A selection of essential tools used to enhance productivity, streamline workflows, and achieve
                    efficient, high-quality results in various projects.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 max-w-5xl mx-auto">
                @foreach ($tools as $tool)
                    <div class="group">
                        <div
                            class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                            <img class="w-full h-16 object-contain group-hover:scale-110 transition-transform duration-300"
                                src="{{ $tool->image() }}" alt="{{ $tool->name }}">
                            <p class="text-center text-sm font-medium text-gray-700 mt-3">{{ $tool->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4">
                Ready to Start Your Next Project?
            </h3>
            <p class="text-blue-100 text-lg mb-8">
                Let's work together to bring your ideas to life with cutting-edge technology and innovative solutions.
            </p>
            <a href="{{ route('contact.index') }}"
                class="inline-flex items-center px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <span>Get In Touch</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
@endsection
