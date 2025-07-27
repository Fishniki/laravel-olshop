<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite('resources/css/app.css')

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-cB4ck4pNnmda1W22"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    <title>My Order</title>
</head>

<body>
    <x-navbar />

    <div class="w-full bg-white shadow-md mx-auto max-w-5xl mt-5 p-4 rounded-lg flex justify-center">
        <ul class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <li>
                <a href="{{ route('pesanan') }}"
                    class="flex flex-col items-center justify-center w-32 h-32 p-5 
                bg-red-200 rounded-lg shadow-lg hover:border hover:border-black
                {{ request()->routeIs('pesanan') ? 'border-2 border-black' : '' }}">
                    <i class="bi bi-credit-card text-4xl text-red-600"></i>
                    <p class="mt-2 text-sm font-semibold">Belum Bayar</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pesanan.paid') }}"
                    class="flex flex-col items-center justify-center w-32 h-32 p-5 
                    bg-blue-200 rounded-lg shadow-lg hover:border hover:border-black 
                    {{ request()->routeIs('pesanan.paid') ? 'border-2 border-black' : '' }}">
                    <i class="bi bi-box text-4xl text-blue-600"></i>
                    <p class="mt-2 text-sm font-semibold">Dikemas</p>
                </a>

            </li>
            <li>
                <a href="{{ route('pesanan.delivered') }}" 
                class="flex flex-col items-center justify-center w-32 h-32 p-5 
                bg-yellow-200 rounded-lg shadow-lg hover:border hover:border-black
                {{ request()->routeIs('pesanan.delivered') ? 'border-2 border-black' : '' }}">
                    <i class="bi bi-truck text-4xl text-yellow-600"></i>
                    <p class="mt-2 text-sm font-semibold">Dikirim</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pesanan.finished') }}" 
                class="flex flex-col items-center justify-center w-32 h-32 p-5 
                bg-green-200 rounded-lg shadow-lg hover:border hover:border-black
                {{ request()->routeIs('pesanan.finished') ? 'border-2 border-black' : '' }}">
                    <i class="bi bi-check-circle text-4xl text-green-600"></i>
                    <p class="mt-2 text-sm font-semibold">Selesai</p>
                </a>
            </li>
        </ul>
    </div>

    <main>
        <div class="w-full max-w-5xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
