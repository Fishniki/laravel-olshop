
<div x-data="{ open: true }" class="bg-gray-800 text-white w-64 min-h-screen transition-all duration-300 flex
flex-col" :class="open ? 'w-64' : 'w-auto items-center'">
    <div class="p-4 flex justify-between items-center">
        <h1 class="text-lg font-semibold" x-show="open">Admin Panel</h1>
        <button @click="open = !open" class="text-white focus:outline-none">
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <nav class="mt-4 flex flex-col" :class="open ? 'w-64' : 'w-auto items-center'">
        <x-sidebar-link href="/dashboard-admin" icon="bi bi-house"  :active="request()->routeIs('admin.dashboard')">Dashboard</x-sidebar-link>
        <x-sidebar-link href="/table/produk" icon="bi bi-basket"  :active="request()->routeIs('table-produk')">Produk</x-sidebar-link>
        <x-sidebar-link href="/create/pakaian" icon="bi bi-plus-square"  :active="request()->routeIs('admin.dashboard')">Tambah Produk</x-sidebar-link>
        <x-sidebar-link href="/table/pesanan" icon="bi bi-bag"  :active="request()->routeIs('table-pesanan')">Pesanan</x-sidebar-link>
        <x-sidebar-link href="/table/pengguna" icon="bi bi-person"  :active="request()->routeIs('admin.users.*')">Users</x-sidebar-link>
        <x-sidebar-link href="/logout-admin" icon="bi bi-box-arrow-right"  :active="request()->routeIs('admin.users.*')">Logout</x-sidebar-link>
    </nav>
</div>
