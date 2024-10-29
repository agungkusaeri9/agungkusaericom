<div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-6">
    @foreach ($latest_projects as $latest)
        <div class="bg-white mb-5 rounded-md">
            <a href="{{ route('projects.show', $latest->slug) }}">
                <img src="{{ $latest->image() }}" alt="{{ $latest->name }}"
                    class="aspect-video h-30 rounded-t-md w-full md:h-[200px] md:w-full object-cover hover:brightness-50">
                <div class="pt-2 px-1">
                    <h1 class="text-xs font-semibold text-slate-800 mb-2 md:text-lg">{{ $latest->name }}</h1>
                    <p class="text-slate-700 text-justify text-xs md:text-base">
                        {{ \Str::limit($latest->meta_description, 120) }}
                    </p>
                </div>
            </a>
        </div>
    @endforeach
</div>
