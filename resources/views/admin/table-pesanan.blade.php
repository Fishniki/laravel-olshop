<x-layout-admin>
    <x-slot:title>Daftar Orderan</x-slot:title>
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-xl">
        <p class="text-sm text-gray-600 mb-4">Lihat semua pesanan yang telah dibuat oleh pelanggan.</p>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">Nama Pelanggan</th>
                        <th class="p-3 border-b">Produk</th>
                        <th class="p-3 border-b">Total Harga</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderans as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $order->id }}</td>
                            <td class="p-3">{{ $order->user->name }}</td>
                            <td class="p-3">
                                <ul class="list-disc pl-4">
                                    @foreach ($order->pakaian as $pakaian)
                                        <li class="text-sm">{{ $pakaian->nama }}
                                            <span class="font-thin italic text-gray-700">
                                                x{{ json_decode($order->jumlah_order, true)[$loop->index] ?? 1 }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-3 font-semibold">Rp{{ number_format($order->total_order, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <span
                                    class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if (in_array($order->status, ['Paid', 'Finished'])) bg-green-200 text-green-800 
                                    @elseif($order->status == 'Pending') 
                                        bg-yellow-200 text-yellow-800 
                                    @elseif($order->status == 'Shipped') 
                                        bg-blue-200 text-blue-800 
                                    @elseif($order->status == 'Delivered') 
                                        bg-purple-200 text-purple-800 
                                    @elseif($order->status == 'Canceled') 
                                        bg-red-200 text-red-800 
                                    @else 
                                        bg-gray-200 text-gray-800 @endif">
                                    {{ $order->status }}
                                </span>

                            </td>
                            <td class="p-3">
                                <a href="{{ route('detail-pesanan', ['id' => $order->id]) }}"
                                    class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
