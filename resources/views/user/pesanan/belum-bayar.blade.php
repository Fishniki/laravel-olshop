    <x-layout-pesanan>
        <div>
            <table class="w-full border-collapse">
                <!-- Header -->
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-4 font-semibold">Produk</th>
                        <th class="p-4 font-semibold text-center">Harga Satuan</th>
                        <th class="p-4 font-semibold text-center">Jumlah</th>
                        <th class="p-4 font-semibold text-center">Total Harga</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody>
                    @foreach ($pesanans as $myorder)
                        @foreach ($myorder->pakaian as $order)
                            <tr class="border-t">
                                <td class="p-4 flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $order->image) }}" alt="Produk" class="w-20 h-20 object-cover">
                                    <p class="font-medium">{{ $order->nama }}</p>
                                    {{-- <p>{{ $myorder->alamat->no_hp }}</p> --}}
                                </td>
                                <td class="p-4 text-center font-medium">
                                    Rp. {{ number_format($order->harga, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    <p class="font-medium">
                                        {{ json_decode($myorder->jumlah_order, true)[$loop->index] ?? 1 }}</p>
                                </td>
                                <td class="p-4 text-center font-medium">
                                    Rp.
                                    {{ number_format(json_decode($myorder->harga_peritem, true)[$loop->index] ?? 1), 0, ',', '.' }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <table class="w-full bg-sky-50 rounded-lg">
                <tbody class="p-4">
                    <tr class="border-t">
                        @foreach ($pesanans as $total)
                            <td class="text-xl text-left font-sans font-medium text-gray-700">Total:
                                <span class="text-base font-semibold text-black">
                                    Rp.{{ number_format($total->total_order, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-right">
                                <button id="pay-button" class="bg-sky-400">
                                    <div class="flex items-center gap-x-3 p-2 rounded-md shadow-md">
                                        <i class="bi bi-cash-coin text-xl text-white"></i>
                                        <p class="text-white text-base font-serif font-medium">Bayar</p>
                                    </div>
                                </button>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>


        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function() {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay('{{ session('snap_token') }}', {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        alert("payment success!");
                        console.log(result);
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            });
        </script>

    </x-layout-pesanan>
