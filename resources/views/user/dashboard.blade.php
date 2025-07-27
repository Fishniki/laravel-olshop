<x-layout>
    <x-slot:title>{{ Auth::user()->name }}</x-slot:title>

    <div class="mx-auto max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8">
        @if (Session::has('Success'))
            <div class=" bg-green-50 w-auto inline-block text-green-600 border border-green-600 px-4 py-2 rounded-md shadow-md transition-opacity duration-500">{{ Session::get('Success') }}</div>
        @endif
        @if (Session::has('Error'))
            <div class=" bg-red-50 w-auto inline-block text-red-600 border border-red-600 px-4 py-2 rounded-md shadow-md transition-opacity duration-500">{{ Session::get('Error') }}</div>
        @endif
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse ($pakaian as $pakaian)
                <a href="{{ route('detail-produk', $pakaian->id) }}">
                    {{-- <p>{{ $pakaian->id }}</p> --}}
                    <div class="group relative shadow-lg border border-gray-500 rounded-md">
                        <img src="{{ asset('storage/'.$pakaian->image) }}" alt="Front of men&#039;s Basic Tee in black."
                            class="aspect-square w-full rounded-t-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        <div class="p-3">
                            <div class="">
                                <h3 class="text-sm text-gray-900 font-medium font-sans md:text-lg">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $pakaian->nama }}
                                </h3>
                                {{-- <p class="mt-1 text-sm text-gray-800 font-medium">Stok: {{ $pakaian->stok }}</p> --}}
                                <p class=" text-sm text-gray-500">Kategori: {{ $pakaian->kategori }}</p>
                            </div>
    
                            <div class="py-1">
                                <i class="bi bi-star-fill text-yellow-500 "></i>
                                <i class="bi bi-star-fill text-yellow-500 "></i>
                                <i class="bi bi-star-fill text-yellow-500 "></i>
                                <i class="bi bi-star-fill text-yellow-500 "></i>
                                <i class="bi bi-star-fill text-yellow-500 "></i>
                            </div>
    
                            <div class="flex justify-between gap-y-2 mt-5">
                                <p class="text-sm font-medium text-gray-900 md:text-lg">Rp
                                    {{ number_format($pakaian->harga, 0, ',', '.') }}
                                </p>
                                
                                    {{-- tombol cart --}}
                                    <form class="z-10" method="POST" action="{{ route('cart-save') }}">
                                        @csrf
                                        <input type="hidden" name="pakaian_id" value="{{ $pakaian->id }}">
                                        <button type="submit" 
                                        class="z-50 w-7 h-7  flex items-center justify-center bg-green-600 text-white rounded-full hover:bg-green-500 cursor-pointer">    
                                            <i class="bi bi-cart"></i>
                                        </button>
                                    </form>
                            </div>
    
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center" colspan="5">Product not found</p>
            @endforelse

            <!-- More products... -->
        </div>
    </div>

</x-layout>
