<div class="grid grid-cols-2 gap-2 md:grid-cols-3 md:gap-6">
    @foreach ($related_projects as $related)
        <div class="bg-white mb-5 rounded-md">
            <a href="{{ route('projects.show', $related->slug) }}">
                <img src="{{ $related->image() }}" alt="{{ $related->name }}"
                    class="aspect-video h-30 rounded-t-md w-full md:h-[150px] md:w-full object-cover">
                <div class="pt-2 px-1">
                    <h1 class="text-xs font-semibold text-slate-800 mb-2 md:text-base">{{ $related->name }}</h1>
                </div>
            </a>
        </div>
    @endforeach
</div>
