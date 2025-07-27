<x-layout-pesanan>
    <div class="w-full max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-xl">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Pesanan Selesai ✅</h2>

        @if ($finished->isEmpty())
            <p class="text-center text-gray-600 italic">Belum ada pesanan yang selesai.</p>
        @else
            @foreach ($finished as $item)
                <ul class="space-y-4">
                    @foreach ($item->pakaians as $pakaian)
                        <li x-data="{ openRating: false }"
                            class="border border-gray-300 p-4 bg-gray-50 rounded-lg shadow-md space-y-2">

                            <!-- Header Item -->
                            <div class="flex items-center gap-x-4">
                                <!-- Gambar -->
                                <img class="w-20 h-20 flex-none rounded-lg object-cover"
                                    src="{{ asset('storage/' . $pakaian->image) }}" alt="Gambar Produk">

                                <!-- Detail -->
                                <div class="flex-1">
                                    <h1 class="text-lg font-semibold text-gray-900">
                                        {{ $pakaian->nama }}
                                        <span
                                            class="text-sm text-gray-600">x{{ json_decode($item->jumlah_order, true)[$loop->index] ?? 1 }}</span>
                                    </h1>
                                    {{-- <p>{{ $item->id }}</p> --}}
                                    <span class="text-base text-gray-800">
                                        Rp{{ number_format(json_decode($item->harga_peritem, true)[$loop->index] ?? 1, 0, ',', '.') }}
                                    </span>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex justify-end gap-3">
                                    <!-- Tombol Rating -->
                                    <button @click="openRating = !openRating"
                                        class="px-4 py-2 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                        Beri Rating
                                    </button>

                                    <!-- Tombol Retur -->
                                    <a href=""
                                        class="px-4 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        Retur
                                    </a>
                                </div>
                            </div>


                            <!-- Form Rating -->
                            <div x-show="openRating" x-transition
                                class="mt-3 p-4 border rounded-lg bg-white shadow-inner"
                                @click.outside="openRating = false" x-data="{ selected: 0, imagePreview: null }">

                                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="pakaian_id" value="{{ $pakaian->id }}">
                                    {{-- <input type="hidden" name="pesanan_id" value="{{ $item->id }}"> --}}

                                    <!-- Gambar -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar
                                            (Opsional)</label>
                                        <input type="file" name="image" accept="image/*"
                                            @change="const file = $event.target.files[0]; 
                                        if (file) { 
                                            const reader = new FileReader(); 
                                            reader.onload = e => imagePreview = e.target.result; 
                                            reader.readAsDataURL(file); 
                                        }"
                                        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">

                                        <!-- Preview -->
                                        <template x-if="imagePreview">
                                            <img :src="imagePreview" alt="Preview Gambar"
                                                class="mt-3 max-h-40 rounded-lg shadow">
                                        </template>
                                    </div>

                                    <!-- Rating -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Rating:</label>
                                        <div class="flex space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button type="button" @click="selected = {{ $i }}"
                                                    class="focus:outline-none">
                                                    <span
                                                        :class="selected >= {{ $i }} ? 'text-yellow-400' :
                                                            'text-gray-300'"
                                                        class="text-2xl transition-transform transform hover:scale-110">
                                                        ★
                                                    </span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" :value="selected">
                                        {{-- <div class="text-sm text-gray-600 mt-1">
                                            <template x-if="selected > 0">
                                                <span x-text="selected + ' dari 5'"></span>
                                            </template>
                                            <template x-if="selected === 0">
                                                <span>Pilih rating</span>
                                            </template>
                                        </div> --}}
                                    </div>

                                    <!-- Ulasan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Ulasan:</label>
                                        <textarea name="ulasan" rows="3" class="w-full border rounded-lg p-2 text-sm focus:ring focus:ring-indigo-300"
                                            placeholder="Tulis ulasan Anda..."></textarea>
                                    </div>

                                    <!-- Submit -->
                                    <div class="text-right">
                                        <button type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                            Kirim
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </li>
                    @endforeach
                </ul>
            @endforeach
        @endif
    </div>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-layout-pesanan>
