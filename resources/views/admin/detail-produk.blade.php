<x-layout-admin>
    <x-slot:title>Detail Produk</x-slot:title>

    <div class="p-6 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-4">{{ $product->nama }}</h1>
        <div class="flex gap-6 mb-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama }}" class="w-48 h-48 object-cover rounded">
            <div>
                <p><strong>Kategori:</strong> {{ $product->kategori }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p><strong>Stok:</strong> {{ $stock_produk }}</p>
                <p><strong>Total Terjual:</strong> {{ $total_terjual }}</p>
                <p><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>
            </div>
        </div>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-4">Komentar Customer</h2>
        @forelse ($ratings as $rating)
            <div class="mb-4 p-4 border rounded">
        {{-- <p>{{ $rating->id }}</p> --}}
                <p class="font-semibold">{{ $rating->user->name }} <span class="text-gray-500">({{ $rating->rating }} ★)</span></p>
                <p>{{ $rating->comment }}</p>

                {{-- Balasan Admin --}}
                {{-- @foreach ($rating->replies as $reply)
                    <div class="ml-6 mt-2 p-3 bg-gray-100 rounded">
                        <p class="text-sm font-semibold">{{ $reply->user->name }} (Admin)</p>
                        <p>{{ $reply->comment }}</p>
                    </div>
                @endforeach --}}

                {{-- Form Balasan Admin --}}
                {{-- <form action="{{ route('admin.ratings.reply', $rating->id) }}" method="POST" class="mt-3">
                    @csrf
                    <textarea name="comment" rows="2" class="w-full border rounded p-2" placeholder="Tulis balasan..."></textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Balas</button>
                </form> --}}
            </div>
        @empty
            <p class="text-gray-500">Belum ada komentar untuk produk ini.</p>
        @endforelse
    </div>
</x-layout-admin>
