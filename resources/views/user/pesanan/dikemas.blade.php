<x-layout-pesanan>
    {{-- <div class="w-full max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-xl"> --}}
        {{-- @if($pesanans->isEmpty())
            <meta http-equiv="refresh" content="2;url={{ route('pesanan.paid') }}">
        @endif --}}


        @foreach ($paid as $item)
            <ul class="space-y-4  rounded-md">
                @foreach ($item->pakaians as $pakaian)
                    <li class="flex gap-x-6 border mt-2 border-gray-500 p-4 bg-gray-50 rounded-lg shadow">
                        <img class="w-20 h-20 flex-none rounded-lg object-cover"
                            src="{{ asset('storage/'.$pakaian->image) }}" alt="Gambar Produk">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <h1 class="text-lg font-semibold text-gray-900">{{ $pakaian->nama }}</h1>
                                <p class="text-sm text-gray-600">x{{ json_decode($item->jumlah_order, true)[$loop->index] ?? 1 }}</p>
                            </div>
                            <p class="text-lg font-bold text-gray-800">
                                Rp.{{ number_format(json_decode($item->harga_peritem, true)[$loop->index] ?? 1, 0, ',', '.') }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endforeach
    {{-- </div> --}}
</x-layout-pesanan>
