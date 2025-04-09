<div class="bg-white mb-5 rounded-md">
    <a href="{{ route('posts.show', $slug) }}">
        <img src="{{ $image }}" alt=""
            class="aspect-video w-full h-60 rounded-t-md  md:h-[150px] object-cover hover:brightness-50">
        <div class="pt-2 px-1">
            <h1 class="text-lg text-justify font-normal text-slate-800 mb-2">{{ $title }}</h1>
            {{-- <div class="mb-2">
                <a href="{{ route('posts.category', $category->slug) }}"
                    class="bg-slate-600 rounded-md text-white text-xs p-1">{{ $category->name }}</a>
            </div> --}}
            {{-- <p class="text-slate-700 text-justify">
                {{ \Str::limit($metadescription, 200) }}
            </p> --}}
        </div>
    </a>
</div>
