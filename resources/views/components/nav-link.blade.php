@props(['active' => false])
{{-- fungsi props adalah mendisable properti yang tidak ingin di tampilkan di dalam inspect element --}}

<a {{ $attributes }} 
    {{-- fungsi $attributes atribut adalah menangkap semua properti yang berada di dalam tag html --}}
    class="{{ $active ? 'bg-gray-900 text-white' : 'text-black' }} 
    hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $active ? 'page' : 'false' }}">{{ $slot }}
</a>
