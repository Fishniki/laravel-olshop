<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite(['resources/css/app.css'])
    <title>Tambah Alamat</title>
</head>

<body>
    <x-header-cart>| Tambah Alamat</x-header-cart>

    <div class="w-full max-w-2xl mx-auto">
        @if (Session::has('Success'))
            <div class="alert alert-success">{{ Session::get('Success') }}</div>
        @endif
        @if (Session::has('Error'))
            <div class="alert alert-danger">{{ Session::get('Error') }}</div>
        @endif
        <form class="space-y-6" action="{{ route('alamat.save') }}" method="POST">
            @csrf
            <div>
                <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama Pemesan:</label>
                <div class="mt-2">
                    <input type="text"
                        class=" block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6
                        @error('nama') is-invalid @enderror"
                        name="nama" id="nama" required>
                    @error('nama')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="no_hp" class="block text-sm/6 font-medium text-gray-900">No. Hp:</label>
                <div class="mt-2">
                    <input type="text"
                        class=" block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6
                        @error('no_hp') is-invalid @enderror"
                        name="no_hp" id="no_hp" required>
                    @error('no_hp')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="provinsi" class="block text-sm/6 font-medium text-gray-900">Provinsi:</label>
                <div class="mt-2">
                    <select
                        class="block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 
                        @error('provinsi') is-invalid @enderror"
                        name="provinsi" id="provinsi" onchange="loadKabkot(this)" required>
                        <option value="" disabled selected>--Pilih Provinsi--</option>
                    </select>
                    @error('provinsi')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="kabkot" class="block text-sm/6 font-medium text-gray-900">Kabupaten/Kota:</label>
                <div class="mt-2">
                    <select
                        class="block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 
                        @error('kabkot') is-invalid @enderror"
                        name="kabkot" id="kabkot" onchange="loadKecamatan(this)" required>
                        <option value="" disabled selected>--Pilih Kota/Kabupaten--</option>
                    </select>
                    @error('kabkot')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="kecamatan" class="block text-sm/6 font-medium text-gray-900">Kecamatan:</label>
                <div class="mt-2">
                    <select
                        class="block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 
                        @error('kecamatan') is-invalid @enderror"
                        name="kecamatan" id="kecamatan" onchange="loadKelurahan(this)" required>
                        <option value="" disabled selected>--Pilih Kecamatan--</option>
                    </select>
                    @error('kecamatan')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="kelurahan" class="block text-sm/6 font-medium text-gray-900">Kelurahan:</label>
                <div class="mt-2">
                    <select
                        class="block w-full rounded-md border border-black focus:border-none bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 
                        @error('kecamatan') is-invalid @enderror"
                        name="kelurahan" id="kelurahan" required>
                        <option value="" disabled selected>--Pilih Kelurahan--</option>
                    </select>
                    @error('kelurahan')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-900">Jenis Alamat:</label>
                <div class="flex gap-x-4">
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="alamat_rumah" name="jenis_alamat" value="rumah"
                            class="text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="alamat_rumah" class="ml-2 text-sm text-gray-700">Rumah</label>
                    </div>
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="alamat_kantor" name="jenis_alamat" value="kantor"
                            class="text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="alamat_kantor" class="ml-2 text-sm text-gray-700">Kantor</label>
                    </div>
                </div>
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-900">Alamat:</label>
                <div class="mt-2">
                    <textarea name="alamat" id="alamat"
                        class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        rows="4" placeholder="Masukkan kelurahan..."></textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Submit Product
                </button>
            </div>
        </form>
    </div>

    {{-- <!-- <script src="{{ secure_asset('/resources/js/script.js') }}"></script> --> --}}
    <script src="{{ secure_asset('/resources/js/script.js') }}"></script>


</body>

</html>
