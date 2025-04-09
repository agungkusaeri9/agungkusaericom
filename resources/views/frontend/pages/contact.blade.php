@extends('frontend.layouts.app')
@section('content')
    <x-Frontend.SectionTitle title="Contact Me"
        description="Feel free to reach out to us for any inquiries, questions, or
        feedback. We’re here to help and look forward
        to
        connecting with you." />

    <div class="grid grid-cols-1 md:grid-cols-2 px-4  justify-center mx-auto">
        <div class="mb-10 md:mb-0">
            <p class="text-gray-600 mb-6">
                Have any questions or feedback? Fill out the form below to get in touch with us.
            </p>
            <div class="flex items-center space-x-3 mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 13.065l-11.15-7.57v13.055c0 1.354 1.09 2.455 2.434 2.455h17.433c1.344 0 2.434-1.101 2.434-2.455v-13.055l-11.151 7.57z" />
                    <path d="M12 11.135l11.15-7.57h-22.3z" />
                </svg>
                <a href="mailto:agung.kusaeri9@gmail.com"
                    class="text-gray-700 hover:text-blue-500">agung.kusaeri9@gmail.com</a>
            </div>

            <!-- WhatsApp Section -->
            <div class="flex items-center space-x-3 mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.52 3.478a11.87 11.87 0 0 0-17.735.048 11.802 11.802 0 0 0-1.248 15.13l-1.362 4.973a.748.748 0 0 0 .922.921l4.973-1.362a11.804 11.804 0 0 0 15.13-1.248 11.87 11.87 0 0 0 .048-17.735zm-3.96 13.781c-.462.922-2.317 1.854-3.208 1.922-.855.061-1.927.043-3.143-.637-3.625-1.833-5.396-4.917-5.552-5.142-.157-.226-1.327-1.77-1.327-3.376 0-1.606.823-2.396 1.115-2.728.29-.33.64-.415.853-.415.214 0 .426.002.615.01.197.008.462-.075.725.553.278.66.947 2.29 1.031 2.454.08.16.128.34.026.54-.104.207-.16.334-.32.514-.157.177-.334.392-.482.525-.157.14-.32.296-.139.583.182.289.808 1.332 1.733 2.157 1.193 1.073 2.194 1.404 2.503 1.544.315.141.497.12.675-.073.173-.183.769-.896.975-1.203.206-.31.412-.258.675-.156.269.1 1.702.802 1.99.949.29.147.484.22.557.342.072.12.072.693-.39 1.615z" />
                </svg>
                <a href="https://wa.me/6282122018025" class="text-gray-700 hover:text-green-500">+628 212 201 8025</a>
            </div>

            <!-- Instagram Section -->
            <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.337 3.608 1.311.975.975 1.249 2.242 1.311 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.337 2.633-1.311 3.608-.975.975-2.242 1.249-3.608 1.311-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.337-3.608-1.311-.975-.975-1.249-2.242-1.311-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.062-1.366.337-2.633 1.311-3.608.975-.975 2.242-1.249 3.608-1.311 1.265-.058 1.645-.07 4.849-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-1.643.074-3.1.373-4.285 1.558-1.185 1.186-1.484 2.642-1.558 4.285-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.074 1.643.373 3.1 1.558 4.285 1.186 1.185 2.642 1.484 4.285 1.558 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.643-.074 3.1-.373 4.285-1.558 1.185-1.186 1.484-2.642 1.558-4.285.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.074-1.643-.373-3.1-1.558-4.285-1.186-1.185-2.642-1.484-4.285-1.558-1.28-.058-1.688-.072-4.947-.072zm0 5.838c-3.404 0-6.163 2.76-6.163 6.163s2.76 6.163 6.163 6.163 6.163-2.76 6.163-6.163-2.76-6.163-6.163-6.163zm0 10.161c-2.203 0-3.997-1.794-3.997-3.997s1.794-3.997 3.997-3.997 3.997 1.794 3.997 3.997-1.794 3.997-3.997 3.997zm6.406-11.845c-.796 0-1.443.648-1.443 1.443s.648 1.443 1.443 1.443 1.443-.648 1.443-1.443-.648-1.443-1.443-1.443z" />
                </svg>
                <a href="https://www.instagram.com/agunguf_s.r" class="text-gray-700 hover:text-pink-500">@agung_s.r</a>
            </div>
        </div>
        <div>
            <form class="max-w-sm mx-auto" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Name</label>
                    <input type="text" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 py-4 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Name" required name="name" value="{{ old('name') }}" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email</label>
                    <input type="text" name="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 py-4 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Email" required value="{{ old('email') }}" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Subject</label>
                    <input type="text" name="subject" id="subject"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 py-4 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="subject" required value="{{ old('subject') }}" />
                    @error('subject')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Message</label>
                    <textarea id="text" name="text" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Message">{{ old('text') }}</textarea>
                    @error('text')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 float-right">
                    <button class="bg-red-700 text-white px-5 py-2 rounded-md">Send Message</button>
                </div>
            </form>
        </div>
    </div>
@endsection
