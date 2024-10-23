@extends('frontend.layouts.app')
@section('content')
    <div class="flex flex-wrap">
        <div class="w-full md:w-2/3">
            <!-- Konten Utama -->
            <div class="flex lg:w-1/2">
                @forelse ($posts as $post)
                    <div class="max-w-sm w-full bg-white border border-gray-200 rounded-lg shadow">
                        <a href="#">
                            <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="text-2xl font-bold">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="font-normal text-gray-700">Here are the biggest enterprise technology acquisitions...
                            </p>
                            <a href="#" class="inline-flex items-center px-3 py-2 bg-blue-700 text-white rounded-lg">
                                Read more
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div>
                {{ $posts->links('pagination::tailwind') }}
            </div>
        </div>
        <div class="w-full md:w-1/3">
            <!-- Sidebar Kanan -->
            <x-Frontend.SidebarRightPost />
        </div>
    </div>
@endsection
