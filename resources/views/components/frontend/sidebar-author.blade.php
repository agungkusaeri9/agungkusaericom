<div class="shadow p-5 rounded-md bg-white border">
    <h2 class="text-center text-md uppercase font-semibold mb-5">About Me</h2>
    <div class="flex justify-center">
        <img src="{{ $setting->author_image() }}" class="h-40 rounded-full aspect-square object-cover" alt="">
    </div>
    <div class="text-center">
        <h2 class="text-xl text-slate-800 font-semibold my-4">{{ $setting->author }}</h2>
        <p class="text-slate-600 text-justify">{{ $setting->author_description }}</p>
    </div>
</div>
