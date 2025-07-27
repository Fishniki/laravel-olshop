<x-layout-admin>
    <x-slot:title>Daftar Pengguna</x-slot:title>
    
    <div class="flex w-full justify-center">
        <ul  class=" divide-gray-100 w-full max-w-3xl">
            @forelse ($users as $user)
            <li class="flex justify-between gap-x-6 py-5 border px-2 mt-2 border-gray-500 rounded-md
            shadow-lg">
                <div class="flex min-w-0 gap-x-4">
                  <div class="min-w-0 flex-auto">
                    <p class="text-sm/6 font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $user->email }}</p>
                  </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                  <p class="text-sm/6 text-gray-900">{{ $user->role }}</p>
                  <p class="mt-1 text-xs/5 text-gray-500">{{ $user->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} </p>
                </div>
              </li>
              @empty
            </ul>
              <p>Data Kosong</p>
              @endforelse
    </div>
</x-layout-admin>