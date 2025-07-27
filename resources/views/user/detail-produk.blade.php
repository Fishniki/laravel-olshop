<x-layout>
    <x-slot:title>
        <a href="javascript:history.back()">
            <i class="bi bi-arrow-left-square-fill"></i> <span>Kembali</span>
        </a>
    </x-slot:title>

    <div class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Gambar Produk -->
        <div class="flex justify-center flex-shrink-0">
            <img src="{{ asset('storage/' . $pakaian->image) }}" alt="{{ $pakaian->nama }}"
                class="w-full max-w-md rounded-lg object-contain">
        </div>

        <!-- Detail Produk -->
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $pakaian->nama }}</h1>
            <p class="text-2xl font-semibold text-gray-700 mb-2">Rp{{ $pakaian->harga }}</p>
            <div class="flex items-center text-purple-600 mb-4">
                <div class="flex">
                    <span class="text-xl">★★★★☆</span>
                </div>
            </div>

            <p class="text-gray-600 mb-6">
                {{ $pakaian->deskripsi }}
            </p>

            <!-- Warna -->
            <div class="mb-6">
                <span class="block text-gray-700 font-medium mb-2">Color</span>
                <div class="flex justify-between space-x-3">
                    <div>
                        <button
                            class="w-8 h-8 rounded-full border-2 border-gray-800 bg-gray-800 focus:ring-2 ring-offset-2 ring-gray-800"></button>
                        <button class="w-8 h-8 rounded-full border bg-white"></button>
                        <button class="w-8 h-8 rounded-full border bg-gray-400"></button>
                    </div>
                    <div>
                        <form action="{{ route('cart-save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pakaian_id" value="{{ $pakaian->id }}">
                            <button type="submit" class="text-gray-500 hover:text-gray-700 text-3xl">
                                <i class="bi bi-cart-plus-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            {{-- <div class="flex items-center space-x-4 mb-6">
                <button
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Beli Sekarang
                </button>
                <button class="text-gray-500 hover:text-gray-700 text-3xl">
                    <i class="bi bi-cart-plus-fill"></i>
                </button>
            </div> --}}

            <hr class="mb-4" />

            <!-- Bagian Fitur (Ulasan dengan dropdown scrollable) -->
            <div x-data="{ open: false }" class="mt-4">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-gray-700 font-semibold py-2">
                    <span>Reviews</span>
                    <svg :class="{ 'rotate-45': open }" class="w-5 h-5 transition-transform duration-200 transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>

                <ul x-show="open" x-transition
                    class="mt-2 pl-4 pr-2 list-disc text-gray-600 space-y-1 max-h-40 overflow-y-auto border rounded-md bg-gray-50">
                    <li>Spacious interior with multiple compartments</li>
                    <li>Durable canvas material, water-resistant</li>
                    <li>Adjustable straps for hand, shoulder, or backpack style</li>
                    <li>High-quality zippers and hardware</li>
                    <li>Great for travel, daily use, and groceries</li>
                    <li>Comfortable to carry even when full</li>
                    <li>Minimalist and stylish design</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Alpine.js untuk interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-layout>
