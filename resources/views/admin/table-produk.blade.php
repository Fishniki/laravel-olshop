<x-layout-admin>
    <x-slot:title>Daftar Produk</x-slot:title> 
    
    <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
        @if (Session::has('Success'))
            <div class="alert alert-success">{{ Session::get('Success') }}</div>
        @endif
        @if (Session::has('Error'))
            <div class="alert alert-danger">{{ Session::get('Error') }}</div>
        @endif

        <div class="mt-6 space-y-4">
            @forelse ($products as $product)
                <div class="flex items-center justify-between gap-4 border rounded-md p-4 bg-white shadow-sm">
                    {{-- Gambar --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk"
                            class="w-24 h-24 rounded object-cover">
                    </div>

                    {{-- Info --}}
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $product->nama }}</h3>
                        <p class="text-sm text-gray-600">Stok: {{ $product->stok }} | Kategori: {{ $product->kategori }}</p>
                        <p class="text-sm text-gray-600">Author: {{ $product->author }}</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>

                    {{-- Aksi --}}
                    <div class="flex flex-col items-center gap-2">
                        <a href="{{ route('edit-pakaian', ['id' => $product->id]) }}"
                            class="p-2 bg-green-600 text-white rounded hover:bg-green-500">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('delete-pakaian', ['id' => $product->id]) }}"
                            class="p-2 bg-red-600 text-white rounded hover:bg-red-500">
                            <i class="bi bi-trash3"></i>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center">Product not found</p>
            @endforelse
        </div>
    </div>
</x-layout-admin>
