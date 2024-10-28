@extends('frontend.layouts.app')
@section('content')
    <div class="gird grid-cols-1">
        <h1 class="text-2xl font-bold text-center">Contact Us</h1>
        <p>Contact</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="">
            <div class="flex">
                <div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M15 18H9" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </div>
                <div>
                    Address
                </div>
            </div>
            <div class="flex">
                <div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M15 18H9" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </div>
                <div>
                    Phone
                </div>
            </div>
        </div>
        <div>
            <form class="max-w-sm mx-auto" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Name</label>
                    <input type="text" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Your Name" required name="name" value="{{ old('name') }}" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email</label>
                    <input type="text" name="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
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
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="subject" required value="{{ old('subject') }}" />
                    @error('subject')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
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
                    <button class="bg-red-700 text-white px-5 py-2 rounded-md uppercase">Send Message</button>
                </div>
            </form>
        </div>
    </div>
@endsection
