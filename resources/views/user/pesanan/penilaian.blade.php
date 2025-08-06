<x-layout>
    <x-slot:title>{{ Auth::user()->name }}</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Penilaian Saya</h1>
    
        @forelse ($penilaian as $item)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 border">
                <div class="flex items-center space-x-6 mb-3">
                    @if ($item->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar Penilaian"
                                class="w-20 h-auto rounded border">
                        </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $item->pakaian->nama ?? 'Nama pakaian tidak ditemukan' }}
                        </h2>
                        <div class="flex items-center space-x-1 text-yellow-400 text-lg">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $item->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        @if ($item->comment)
                            <p class="text-gray-700">{{ $item->comment }}</p>
                        @endif
                    </div>
                </div>
    
    
            </div>
        @empty
            <div class="text-center text-gray-600 py-10">
                <p>Kamu belum memberikan penilaian untuk barang apapun.</p>
            </div>
        @endforelse
    </div>
</x-layout>