<x-layout-admin>
    <x-slot:title>Detail Pesanan</x-slot:title>

    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-xl">

        <!-- Informasi Pemesan -->
        <div class="mb-4 p-4 bg-gray-100 rounded-lg">
            <p class="text-lg font-semibold"> {{ $order->user->name }}</p>
            
            <p class="text-sm text-gray-600">
                <span class="font-bold">No. Telepon:</span> {{ $order->alamat->no_hp }}
            </p>
            
            <p class="text-sm text-gray-600">
                <span class="font-bold">Alamat:</span>
                {{ $order->alamat->alamat }}, 
                {{ $order->alamat->kelurahan }}, 
                {{ $order->alamat->kecamatan }}, 
                {{ $order->alamat->kabkot }}, 
                {{ $order->alamat->provinsi }}
            </p>
        
            <!-- Form Update Status -->
            <div>
                <form action="{{ route('update-status', $order->id) }}" method="POST" class="flex items-center gap-2 mt-5">
                    @csrf
                    @method('PUT')
            
                    <label for="status" class="text-sm font-bold text-gray-600">Status:</label>
                    <select name="status" id="status" class="border border-gray-300 rounded px-1 py-1">
                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Paid" {{ $order->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Finished" {{ $order->status == 'Finished' ? 'selected' : '' }}>Finished</option>
                        <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
            
                    <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Save Changes
                    </button>
                </form>
                <p class="italic text-xs">#Ubah status jika paket sudah siap dikirim, dikemas, atau sudah sampai</p>
            </div>
        </div>
        

        <!-- Detail Produk dalam Pesanan -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3 border-b">Nama Produk</th>
                        <th class="p-3 border-b">Jumlah</th>
                        <th class="p-3 border-b">Harga per Item</th>
                        <th class="p-3 border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->pakaian as $index => $pakaian)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $pakaian->nama }}</td>
                            <td class="p-3">{{ $order->jumlah_order[$index] }}</td>
                            <td class="p-3">Rp{{ number_format($order->harga_peritem[$index], 0, ',', '.') }}</td>
                            <td class="p-3 font-semibold">
                                Rp{{ number_format($order->jumlah_order[$index] * $order->harga_peritem[$index], 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Harga -->
        <div class="mt-6 text-right">
            <p class="text-lg font-semibold">Total: Rp{{ number_format($order->total_order, 0, ',', '.') }}</p>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</x-layout-admin>
