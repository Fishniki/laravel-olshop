<x-layout-admin>
    <x-slot:title>Edit Produk</x-slot:title>
    <div class="flex min-h-full">

        <div class="  mx-auto md:mx-20 sm:w-full sm:max-w-3xl">
            <form class="space-y-6" action="{{ route('update-pakaian', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        {{-- Nama --}}
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-900">Nama:</label>
                            <div class="mt-2">
                                <input type="text"
                                    class=" block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6
                                @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ $product->nama }}" required>
                                @error('nama')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-900">Harga:</label>
                            <div class="mt-2">
                                <input type="number" name="harga" id="harga" value="{{ $product->harga }}"
                                    required
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
                                    <input type="number" name="stok" id="stok" value="{{ $product->stok }}"
                                        required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('stok') is-invalid @enderror">
                                    @error('stok')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-900">Kategori:</label>
                                <div class="mt-2">
                                    <select
                                        class="block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 
                            @error('kategori') is-invalid @enderror"
                                        name="kategori" id="kategori" required>
                                        <option value="" disabled>Pilih Kategori</option>
                                        <option value="Baju" {{ $product->kategori == 'Baju' ? 'selected' : '' }}>Baju
                                        </option>
                                        <option value="Celana" {{ $product->kategori == 'Celana' ? 'selected' : '' }}>
                                            Celana
                                        </option>
                                        <option value="Sepatu" {{ $product->kategori == 'Sepatu' ? 'selected' : '' }}>
                                            Sepatu
                                        </option>
                                        <option value="Hodie" {{ $product->kategori == 'Hodie' ? 'selected' : '' }}>
                                            Hodie
                                        </option>
                                        <option value="Topi" {{ $product->kategori == 'Topi' ? 'selected' : '' }}>
                                            Topi
                                        </option>
                                        <option value="Jaket" {{ $product->kategori == 'Jaket' ? 'selected' : '' }}>
                                            Jaket
                                        </option>
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
                                <label for="bobot" class="block text-sm font-medium text-gray-900">Bobot
                                    Barang:</label>
                                <div class="mt-2">
                                    <input type="text" name="bobot" id="bobot" value="{{ $product->bobot }}" placeholder="Kg | Gram" required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('bobot') is-invalid @enderror">
                                    @error('bobot')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="sent_from" class="block text-sm font-medium text-gray-900">Dikirim
                                    Dari:</label>
                                <div class="mt-2">
                                    <input type="text" name="sent_from" id="sent_from" value="{{ $product->sent_from }}" placeholder="Jakarta" required
                                        class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('sent_from') is-invalid @enderror">
                                    @error('sent_from')
                                        <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        {{-- Gambar --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-900">Image:</label>
                            <div class="mt-2">
                                <input type="file" name="image" id="image"
                                    class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 focus:outline-indigo-600 sm:text-sm @error('image') is-invalid @enderror">
                                @error('image')
                                    <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-900">Deskripsi
                                Barang:</label>
                            <div class="mt-2">
                                <textarea name="deskripsi" id="deskripsi"  rows="6"
                                    class="block w-full rounded-md border border-black bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm @error('deskripsi') is-invalid @enderror"></textarea>
                                @error('deskripsi')
                                    <p class="invalid-feedback text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
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

</x-layout-admin>
