<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite('resources/css/app.css')
    <title>Checkout</title>
</head>

<body>
    <x-header-cart> | Checkout </x-header-cart>

    <form action="{{ route('chekout.payment') }}" method="POST">
        @csrf  {{-- Menambahkan CSRF token --}}
        
        <div class="mt-5 flex flex-col items-center min-h-screen">
            {{-- Section Lokasi --}}
            <div class="w-full max-w-4xl border border-gray-200 rounded-lg bg-white shadow-md overflow-hidden">
                <div class="w-full p-4">
                    <div class="flex gap-2 items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="bi bi-geo-alt"></i>
                            <h1 class="text-xl font-semibold">Lokasi</h1>
                        </div>

                        <a href="/alamat">
                            <div class="border px-3 py-1 rounded-lg bg-sky-300 shadow-md flex items-center gap-2">
                                <i class="bi bi-map"></i>
                                <p>Atur Lokasi</p>
                            </div>
                        </a>
                    </div>

                    <div class="mt-2">
                        @forelse ($alamat as $lokasi)
                        <div class="bg-white shadow-md rounded-lg p-4 w-full border border-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-gray-800">
                                        <input type="hidden" name="alamat_id" value="{{ $lokasi->id }}">
                                        
                                        <h1 class="text-lg font-bold font-mono">{{ $lokasi->nama }}</h1>
                                        <span>|</span>
                                        <p class="text-base font-sans">{{ $lokasi->no_hp }}</p>
                                        <span>|</span>
                                        <p class="capitalize font-medium text-gray-600">{{ $lokasi->jenis_alamat }}</p>
                                    </div>
                                    <p class="text-gray-700 font-sans text-sm mt-1 leading-relaxed">
                                        <span class="font-semibold">{{ $lokasi->provinsi }}</span>, 
                                        {{ $lokasi->alamat }},
                                        <span class="text-black font-medium">KECAMATAN</span> {{ $lokasi->kecamatan }},
                                        <span class="text-black font-medium">KELURAHAN</span> {{ $lokasi->kelurahan }},
                                        {{ $lokasi->kabkot }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty    
                            <p class="text-base text-gray-700 font-sans">Alamat belum diatur</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Section Barang --}}
            @if (session('selectedItems'))
                <div class="w-full mt-5 max-w-4xl border border-gray-200 rounded-lg bg-white shadow-md overflow-hidden">
                    <ul role="list" class="divide-y divide-gray-100 p-3">
                        @foreach(session('selectedItems') as $index => $item)
                            <li class="py-2 px-3">
                                <input type="hidden" name="pakaian_id[]" value="{{ $item['id'] }}">
                                <input type="hidden" name="jumlah_order[]" value="{{ $item['jumlah'] }}">
                                <input type="hidden" name="harga_peritem[]" value="{{ $item['subtotal'] }}">

                                <div class="flex gap-x-4">
                                    <img class="size-12 flex-none bg-gray-50 bg-cover"
                                        src="{{ asset('storage/'.$item['image']) }}" alt="Gambar Produk">
                                    <div class="w-full flex items-center justify-between gap-x-4">
                                        <div>
                                            <h1 class="text-sm font-semibold text-gray-900">{{ $item['nama'] }}</h1>
                                            <p class="text-xs text-gray-600">Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
                                        </div>
                                        <p class="truncate text-xs text-gray-500">x{{ $item['jumlah'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Rincian Pembayaran --}}
                <div class="w-full mt-5 max-w-4xl border border-gray-200 rounded-lg bg-white shadow-md overflow-hidden">
                    <div class="w-full py-2 px-2">
                        <h1 class="text-xl font-sans">Rincian Pembayaran</h1>
                        <table class="w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
                            <tbody>
                                @foreach(session('selectedItems') as $item)
                                    <tr class="border-t">
                                        <td class="py-3 px-6 text-left">{{ $item['nama'] }}</td>
                                        <td class="py-3 px-6 text-right">Rp.{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr class="border-t bg-gray-100">
                                    <td class="py-3 px-6 text-left font-semibold">Total</td>
                                    <td class="py-3 px-6 text-right font-semibold">Rp.{{ number_format(session('totalsemuaItem'), 0, ',', '.') }}</td>
                                    <input type="hidden" name="total_order" value="{{ (int) session('totalsemuaItem') }}">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>    

                <div class="w-full max-w-4xl flex justify-between">
                    <a href="{{ route('chekout.cancel') }}" class="w-40 px-3 py-2 bg-red-400 mt-5">Batal</a>
                    <button type="submit" class="w-40 max-w-4xl px-3 py-2 bg-sky-400 mt-5">Buat Pesanan</button>
                </div>
            @else
                <p class="text-gray-500 mt-5">Tidak ada barang yang dipilih</p>
            @endif
        </div>
    </form>
</body>
</html>
