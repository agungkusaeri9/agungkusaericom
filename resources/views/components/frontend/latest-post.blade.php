<div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-6">
    @foreach ($latest_posts as $latest)
        <div class="bg-white mb-5 rounded-md">
            <a href="{{ route('posts.show', $latest->slug) }}">
                <img src="{{ $latest->image() }}" alt=""
                    class="aspect-video h-30 rounded-t-md w-full h-[150px] object-cover hover:brightness-50">
                <div class="pt-2 px-1">
                    <h1 class="text-xs font-normal text-justify text-slate-800 mb-2 md:text-base">{{ $latest->title }}
                    </h1>
                </div>
            </a>
        </div>
    @endforeach
</div>
