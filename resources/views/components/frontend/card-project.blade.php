<div class="bg-white mb-5 rounded-md">
    <a href="{{ route('projects.show', $project->slug) }}">
        <img src="{{ $project->image() }}" alt="{{ $project->name }}"
            class="aspect-video h-60 rounded-t-md w-full md:h-[150px] object-cover hover:brightness-50 border-gray-100">
        <div class="pt-2 px-1">
            {{-- <div class="mb-2">
                <a href="{{ route('projects.category', $project->category->slug) }}"
                    class="bg-slate-600 rounded-md text-white text-xs p-1">{{ $project->category->name }}</a>
            </div> --}}
            <h1 class="text-xs font-normal text-slate-800 mb-2 md:text-lg text-justify">{{ $project->name }}
            </h1>
            {{-- <p class="text-slate-700 text-justify">
                {{ \Str::limit($project->meta_description, 200) }}
            </p> --}}
        </div>
    </a>
</div>
