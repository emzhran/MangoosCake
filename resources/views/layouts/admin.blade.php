<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul halaman akan dinamis, dengan judul default jika tidak diatur --}}
    <title>@yield('title', "Admin Mangoo's Kue")</title>

    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-pacifico { font-family: 'Pacifico', cursive; }
    </style>
</head>
<body class="bg-orange-50">

    <div class="flex h-screen bg-gray-100">
        {{-- Memasukkan komponen sidebar dari file terpisah --}}
        @include('partials.sidebar')

        <!-- Konten Utama -->
        <main class="flex-1 p-6 md:p-10 overflow-y-auto">
            {{-- Di sinilah konten dari setiap halaman akan ditampilkan --}}
            @yield('content')
        </main>
    </div>

    {{-- Tempat untuk script tambahan per halaman jika diperlukan --}}
    @stack('scripts')
</body>
</html>
