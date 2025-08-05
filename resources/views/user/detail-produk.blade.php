<x-layout>
    <x-slot:title>
        <a href="javascript:history.back()">
            <i class="bi bi-arrow-left-square-fill"></i> <span>Kembali</span>
        </a>
    </x-slot:title>

    <div class="max-w-6xl mx-auto p-6 gap-8 min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Gambar Produk -->
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $pakaian->image) }}" alt="{{ $pakaian->nama }}"
                    class="w-full max-w-md rounded-lg object-contain shadow-md">
            </div>

            <!-- Detail Produk -->
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $pakaian->nama }}</h1>
                <p class="text-2xl font-semibold text-gray-700 mb-2">Rp{{ number_format($pakaian->harga, 0, ',', '.') }}</p>
                <div class="flex items-center text-yellow-500 text-xl mb-4">
                    ★★★★☆
                </div>

                <p class="text-gray-600 mb-6">
                    {{ $pakaian->deskripsi }}
                </p>

                <!-- Warna (dummy tombol warna) -->
                <div class="mb-6">
                    <span class="block text-gray-700 font-medium mb-2">Pilih Warna</span>
                    <div class="flex space-x-3">
                        <button class="w-8 h-8 rounded-full border-2 border-gray-800 bg-gray-800 focus:ring-2 ring-offset-2 ring-gray-800"></button>
                        <button class="w-8 h-8 rounded-full border bg-white"></button>
                        <button class="w-8 h-8 rounded-full border bg-gray-400"></button>
                    </div>
                </div>

                <!-- Tombol Keranjang -->
                <form action="{{ route('cart-save') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="pakaian_id" value="{{ $pakaian->id }}">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                    </button>
                </form>

                <hr class="my-6" />
            </div>
        </div>

        <!-- Ulasan / Ratings -->
        <div x-data="{ open: false }" class="mt-10 w-full">
            <button @click="open = !open"
                class="flex items-center justify-between w-full text-gray-700 font-semibold py-2 border-b">
                <span>Ulasan Pelanggan</span>
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transition-transform duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-transition class="mt-4 max-h-60 overflow-y-auto border rounded-md bg-gray-50 p-4 space-y-4">
                @forelse ($pakaian->ratings as $rating)
                    <div class="border-b pb-2">
                        <div class="flex items-center justify-between mb-1">
                            <strong class="text-gray-800">{{ $rating->user->name }}</strong>
                            <div class="text-yellow-500 text-sm">
                                {{ str_repeat('★', $rating->rating) }}{{ str_repeat('☆', 5 - $rating->rating) }}
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm">{{ $rating->comment }}</p>
                        @if($rating->image)
                            <img src="{{ asset('storage/' . $rating->image) }}" class="w-32 mt-2 rounded border">
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada ulasan untuk produk ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-layout>
