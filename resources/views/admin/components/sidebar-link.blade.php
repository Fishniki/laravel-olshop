@props(['href', 'icon', 'active' => false, 'open' => true])

<a href="{{ $href }}" class="flex items-center px-4 py-2 hover:bg-gray-700 transition rounded-md text-sm"
    :class="{ 'bg-gray-900': {{ $active ? 'true' : 'false' }} }">
    <span class="material-icons-outlined text-lg"
        :class="open !? 'hidden w-auto' : 'block w-0'">
        <i class="{{ $icon }}"></i>
    </span>

    <span class="ml-3 transition-all duration-300"
        :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0 overflow-hidden'">
        {{ $slot }}
    </span>
</a>