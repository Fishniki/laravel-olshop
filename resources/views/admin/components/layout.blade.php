<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <x-sidebar />
        <div class="flex-1 h-screen">
            <x-header-admin>{{ $title }}</x-header-admin>
            {{ $slot }}
        </div>
    </div>
</body>
</html>
