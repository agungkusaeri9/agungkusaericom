@extends('frontend.layouts.app')
@section('content')
    <x-Frontend.SectionTitle title="Contact Me"
        description="Feel free to reach out to us for any inquiries, questions, or
        feedback. We're here to help and look forward
        to
        connecting with you." />

    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Contact Information Section -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Get in Touch</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Have any questions or feedback? I'd love to hear from you. Send me a message and I'll respond as
                        soon as possible.
                    </p>

                    <!-- Contact Methods -->
                    <div class="space-y-6">
                        <!-- Email -->
                        <div
                            class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 13.065l-11.15-7.57v13.055c0 1.354 1.09 2.455 2.434 2.455h17.433c1.344 0 2.434-1.101 2.434-2.455v-13.055l-11.151 7.57z" />
                                    <path d="M12 11.135l11.15-7.57h-22.3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <a href="mailto:agung.kusaeri9@gmail.com"
                                    class="text-gray-800 hover:text-blue-600 font-medium transition-colors duration-200">
                                    agung.kusaeri9@gmail.com
                                </a>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div
                            class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.52 3.478a11.87 11.87 0 0 0-17.735.048 11.802 11.802 0 0 0-1.248 15.13l-1.362 4.973a.748.748 0 0 0 .922.921l4.973-1.362a11.804 11.804 0 0 0 15.13-1.248 11.87 11.87 0 0 0 .048-17.735zm-3.96 13.781c-.462.922-2.317 1.854-3.208 1.922-.855.061-1.927.043-3.143-.637-3.625-1.833-5.396-4.917-5.552-5.142-.157-.226-1.327-1.77-1.327-3.376 0-1.606.823-2.396 1.115-2.728.29-.33.64-.415.853-.415.214 0 .426.002.615.01.197.008.462-.075.725.553.278.66.947 2.29 1.031 2.454.08.16.128.34.026.54-.104.207-.16.334-.32.514-.157.177-.334.392-.482.525-.157.14-.32.296-.139.583.182.289.808 1.332 1.733 2.157 1.193 1.073 2.194 1.404 2.503 1.544.315.141.497.12.675-.073.173-.183.769-.896.975-1.203.206-.31.412-.258.675-.156.269.1 1.702.802 1.99.949.29.147.484.22.557.342.072.12.072.693-.39 1.615z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">WhatsApp</p>
                                <a href="https://wa.me/6282122018025"
                                    class="text-gray-800 hover:text-green-600 font-medium transition-colors duration-200">
                                    +628 212 201 8025
                                </a>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div
                            class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.337 3.608 1.311.975.975 1.249 2.242 1.311 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.337 2.633-1.311 3.608-.975.975-2.242 1.249-3.608 1.311-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.337-3.608-1.311-.975-.975-1.249-2.242-1.311-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.062-1.366.337-2.633 1.311-3.608.975-.975 2.242-1.249 3.608-1.311 1.265-.058 1.645-.07 4.849-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-1.643.074-3.1.373-4.285 1.558-1.185 1.186-1.484 2.642-1.558 4.285-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.074 1.643.373 3.1 1.558 4.285 1.186 1.185 2.642 1.484 4.285 1.558 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.643-.074 3.1-.373 4.285-1.558 1.185-1.186 1.484-2.642 1.558-4.285.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.074-1.643-.373-3.1-1.558-4.285-1.186-1.185-2.642-1.484-4.285-1.558-1.28-.058-1.688-.072-4.947-.072zm0 5.838c-3.404 0-6.163 2.76-6.163 6.163s2.76 6.163 6.163 6.163 6.163-2.76 6.163-6.163-2.76-6.163-6.163-6.163zm0 10.161c-2.203 0-3.997-1.794-3.997-3.997s1.794-3.997 3.997-3.997 3.997 1.794 3.997 3.997-1.794 3.997-3.997 3.997zm6.406-11.845c-.796 0-1.443.648-1.443 1.443s.648 1.443 1.443 1.443 1.443-.648 1.443-1.443-.648-1.443-1.443-1.443z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Instagram</p>
                                <a href="https://www.instagram.com/agunguf_s.r"
                                    class="text-gray-800 hover:text-pink-600 font-medium transition-colors duration-200">
                                    @agung_s.r
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Send a Message</h3>
                    <p class="text-gray-600">I'll get back to you as soon as possible</p>
                </div>

                <form method="post" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" id="name" name="name"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter your full name" required value="{{ old('name') }}" />
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" id="email" name="email"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter your email address" required value="{{ old('email') }}" />
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Subject Field -->
                    <div>
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subject
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <input type="text" id="subject" name="subject"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="What's this about?" required value="{{ old('subject') }}" />
                        </div>
                        @error('subject')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div>
                        <label for="text" class="block text-sm font-semibold text-gray-700 mb-2">
                            Message
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <textarea id="text" name="text" rows="5"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none"
                                placeholder="Tell me more about your inquiry...">{{ old('text') }}</textarea>
                        </div>
                        @error('text')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <span>Send Message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
