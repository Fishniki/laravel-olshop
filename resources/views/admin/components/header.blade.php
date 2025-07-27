<div class="bg-gray-100 w-full shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $slot }}</h1>
        <span class="font-thin text-gray-950 uppercase">{{ Auth::guard('admin')->user()->name }}</span>
        {{-- fungsi $slot adalah mengambil data dari tengah components seperti ini =><x-header >Home Page</x-header > --}}
    </div>
</div>