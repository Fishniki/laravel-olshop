<x-layout-admin>
    {{-- <script>
        function formatNumber(input) {
            let start = input.selectionStart;

            // Ambil nilai input tanpa karakter selain angka
            let value = input.value.replace(/\D/g, '');

            // Format angka dengan titik sebagai pemisah ribuan
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Perbarui nilai input
            input.value = value;

            // Kembalikan posisi kursor setelah perubahan
            let newPosition = start + (input.value.length - value.length);
            input.setSelectionRange(newPosition, newPosition);
        }
    </script> --}}
    <x-slot:title>Tambah Produk</x-slot:title>
    <div class="">
        <div class="mt-10  mx-auto md:mx-20 sm:w-full sm:max-w-3xl">
            <form class="space-y-6" action="{{ route('store-pakaian') }}" method="POST" enctype="multipart/form-data">
                @csrf
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        {{-- Nama --}}
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-900">Nama:</label>
                            <div class="mt-2">
                                <input type="text" name="nama" id="nama" required
                                    class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('nama') is-invalid @enderror">
                                @error('nama')
                                    <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
        
                        {{-- Harga --}}
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-900">Harga Rp:</label>
                            <div class="mt-2">
                                <input type="number" name="harga" id="harga" required
                                    class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('harga') is-invalid @enderror">
                                @error('harga')
                                    <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
        
                        {{-- Stok dan Kategori --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-900">Stok:</label>
                                <div class="mt-2">
                                    <input type="number" name="stok" id="stok" required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('stok') is-invalid @enderror">
                                    @error('stok')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
        
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-900">Kategori:</label>
                                <div class="mt-2">
                                    <select name="kategori" id="kategori" required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 focus:outline-indigo-600 sm:text-sm @error('kategori') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option value="Baju">Baju</option>
                                        <option value="Celana">Celana</option>
                                        <option value="Sepatu">Sepatu</option>
                                        <option value="Hodie">Hodie</option>
                                        <option value="Topi">Topi</option>
                                        <option value="Jaket">Jaket</option>
                                    </select>
                                    @error('kategori')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
        
                        {{-- Bobot dan Sent From --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="bobot" class="block text-sm font-medium text-gray-900">Bobot Barang:</label>
                                <div class="mt-2">
                                    <input type="text" name="bobot" id="bobot" placeholder="Kg | Gram" required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('bobot') is-invalid @enderror">
                                    @error('bobot')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
        
                            <div>
                                <label for="sent_from" class="block text-sm font-medium text-gray-900">Dikirim Dari:</label>
                                <div class="mt-2">
                                    <input type="text" name="sent_from" id="sent_from" placeholder="Jakarta" required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('sent_from') is-invalid @enderror">
                                    @error('sent_from')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        {{-- Deskripsi --}}
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-900">Deskripsi Barang:</label>
                            <div class="mt-2">
                                <textarea name="deskripsi" id="deskripsi" rows="6" required
                                    class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('deskripsi') is-invalid @enderror"></textarea>
                                @error('deskripsi')
                                    <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="space-y-4 ">
                        {{-- Gambar --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-900">Image:</label>
                            <div class="mt-2">
                                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" required
                                    class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 focus:outline-indigo-600 sm:text-sm @error('image') is-invalid @enderror">
                                @error('image')
                                    <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                        <!-- Preview Image -->
                            <div class="mt-4  min-h-[24rem] border-black rounded-md border border-dashed">
                                <img id="preview"  class=" max-w-full rounded-md" />

                                <!-- <span id="preview-placeholder" class="text-gray-400 text-sm absolute">Preview Gambar</span> -->
                            </div>
                        
                        <!-- End Preview Image -->
                    </div>
                </div>
        
                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-indigo-600">
                        Submit Product
                    </button>
                </div>
            </form>
        </div>
        
    </div>

        <script src="{{ secure_asset('/resources/js/preview_image.js') }}"></script>
    {{-- <script src="{{ asset('/resources/js/preview-image.js') }}"></script> --}}



</x-layout-admin>
