<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PerpusKu - Perpustakaan Digital')</title>
    <meta name="description" content="@yield('description', 'PerpusKu - Platform peminjaman buku online terbaik. Temukan ribuan buku dan lakukan peminjaman dengan mudah.')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📚</text></svg>">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-secondary-50 text-secondary-900">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl">📚</span>
                        <span class="text-2xl font-bold text-gradient">PerpusKu</span>
                    </div>
                    <p class="text-secondary-400 max-w-md">
                        Platform peminjaman buku online yang memudahkan Anda menemukan dan meminjam buku favorit. 
                        Akses ribuan buku dari berbagai kategori.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-secondary-400 hover:text-primary-400 transition">Beranda</a></li>
                        <li><a href="/books" class="text-secondary-400 hover:text-primary-400 transition">Katalog Buku</a></li>
                        <li><a href="/loans" class="text-secondary-400 hover:text-primary-400 transition">Peminjaman Saya</a></li>
                        <li><a href="#" class="text-secondary-400 hover:text-primary-400 transition">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-secondary-400">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Jl. Perpustakaan No. 123</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>info@perpusku.id</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>(021) 123-4567</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-secondary-800 mt-8 pt-8 text-center text-secondary-400">
                <p>&copy; {{ date('Y') }} PerpusKu. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
