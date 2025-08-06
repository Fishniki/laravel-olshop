<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite('resources/css/app.css')
    {{-- @vite('resources/js/jumlah.js') --}}
    <title>Keranjang Belanja</title>
</head>
<body>
    <x-layout>
        <x-slot:title>Keranjang Belanja</x-slot:title>

        <form action="{{ route('chekout.proses') }}" method="POST">
            @csrf
            <div class="mt-5 flex flex-col items-center">
                <div class="w-full max-w-4xl border border-gray-200 rounded-lg bg-white shadow-md overflow-hidden">
                        <table class="w-full border-collapse">
                            <!-- Header -->
                            <thead class="bg-gray-100">
                                <tr class="text-left">
                                    <th class="p-4 font-semibold text-center">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th class="p-4 font-semibold">Produk</th>
                                    <th class="p-4 font-semibold text-center">Harga Satuan</th>
                                    <th class="p-4 font-semibold text-center">Kuantitas</th>
                                    <th class="p-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            
                            <!-- Body -->
                            <tbody>
                                @forelse ($carts as $cart)
                                <tr class="border-t" data-harga="{{ $cart->pakaian->harga }}">
                                    <td class="p-4 text-center">
                                        <input type="checkbox" name="cheked_id[]" value="{{ $cart->pakaian_id }}" class="check-item">
                                    </td>
                                    <td class="p-4 flex items-center space-x-4">
                                        <img src="{{ asset('storage/'.$cart->pakaian->image) }}" alt="Produk" class="w-20 h-20 object-cover">
                                        <p class="font-medium">{{ $cart->pakaian->nama }}</p>
                                    </td>
                                    <td class="p-4 text-center font-medium">Rp. {{ number_format($cart->pakaian->harga, 0, ',', '.') }}</td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center items-center border rounded-md px-2 py-1">
                                            <button type="button" class="px-2 decrement">-</button>
                                            <input type="text" name="quantities[{{ $cart->pakaian_id }}]" value="1" class="w-10 text-center border-none outline-none quantity" readonly>
                                            <button type="button" class="px-2 increment">+</button>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('cart-delete', ['id' => $cart->id]) }}" class="text-red-500">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @empty
                                <p class="text-center p-4">Keranjang kosong</p>
                            @endforelse
                        </table>
            
                        <!-- Voucher Section -->
                        <div class="p-4 border-t text-sm flex items-center">
                            <span class="text-red-500">🎟️ Tersedia Voucher Diskon s/d Rp5RB</span>
                            <a href="#" class="ml-2 text-blue-500">Voucher Lainnya</a>
                        </div>
            
                        <!-- Checkout Section -->
                        <div class="w-full max-w-4xl border border-gray-200 p-3 bg-white shadow-md overflow-hidden flex justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="select-all-footer" class="mr-2">
                                <p>Pilih Semua (<span class="total-produk">0</span> produk)</p>
                            </div>
                
                            <div class="flex items-center gap-x-4">
                                <p class="font-semibold total-harga">Rp 0</p>
                                <button type="submit" class="p-1 px-2 py-1 rounded-md bg-sky-300 font-semibold">
                                    Checkout
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </form>
    
    </x-layout>
    
    <script src="{{ secure_asset('resources/js/jumlah.js') }}"></script>

</body>
</html>
