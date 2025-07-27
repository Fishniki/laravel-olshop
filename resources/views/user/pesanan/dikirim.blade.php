<x-layout-pesanan>
    @if($delivered->isEmpty())
        <div class="text-center text-gray-500 mt-10">
            <p>Tidak ada pesanan yang telah dikirim.</p>
            <meta http-equiv="refresh" content="2;url={{ route('pesanan.paid') }}">
        </div>
    @endif

    @foreach ($delivered as $item)
        <div class="p-6 bg-white shadow-lg rounded-lg mt-4">
            <!-- Tampilkan Waktu Pengiriman -->
            <div class="p-6 bg-white shadow-md rounded-lg border border-gray-300">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Detail Pengiriman</h2>
            
                <!-- Nama Penerima -->
                <div class="flex items-center space-x-2">
                    <p class="text-base text-gray-600 font-medium">Penerima:</p>
                    <span class="text-base font-semibold text-gray-900">{{ $item->alamat->nama }}</span>
                </div>
            
                <!-- Tanggal Pengiriman -->
                <div class="flex items-center space-x-2 mt-1">
                    <p class="text-base text-gray-600 font-medium">Pesanan dikirim pada:</p>
                    <span class="text-base font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y, H:i') }}
                    </span>
                </div>
            
                <!-- Estimasi Sampai -->
                <div class="flex items-center space-x-2 mt-1">
                    <p class="text-base text-gray-600 font-medium">Estimasi sampai:</p>
                    <span class="text-base font-semibold text-green-700">
                        {{ \Carbon\Carbon::parse($item->updated_at)->addDays(2)->translatedFormat('d F Y') }}
                    </span>
                </div>
            
                <!-- Tujuan Pengiriman -->
                <div class="mt-3">
                    <p class="text-base text-gray-600 font-medium">Tujuan Pengiriman:</p>
                    <p class="text-sm font-semibold text-gray-800 leading-relaxed">
                        {{ $item->alamat->alamat }}, KEL.{{ $item->alamat->kelurahan }}, 
                        KEC.{{ $item->alamat->kecamatan }}, {{ $item->alamat->kabkot }}, 
                        {{ $item->alamat->provinsi }}
                    </p>
                </div>
            </div>
            


            <ul class="mt-4 space-y-4">
                @foreach ($item->pakaian as $pakaian)
                    <li class="flex gap-x-6 border border-gray-300 p-4 bg-gray-50 rounded-lg shadow-md">
                        <img class="w-20 h-20 flex-none rounded-lg object-cover"
                            src="{{ asset('storage/'.$pakaian->image) }}" alt="Gambar Produk">
                        
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <h1 class="text-lg font-semibold text-gray-900">{{ $pakaian->nama }}</h1>
                                <p class="text-sm text-gray-600">Jumlah: x{{ json_decode($item->jumlah_order, true)[$loop->index] ?? 1 }}</p>
                            </div>
                            <p class="text-lg font-bold text-gray-800">
                                Rp.{{ number_format(json_decode($item->harga_peritem, true)[$loop->index] ?? 1, 0, ',', '.') }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</x-layout-pesanan>
