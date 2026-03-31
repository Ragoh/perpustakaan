{{-- 
    Komponen Navbar untuk halaman user
    Menampilkan logo, menu navigasi, search, dan user dropdown
    Dengan auth state yang dinamis
--}}
@props(['transparent' => false])

<nav class="{{ $transparent ? 'absolute top-0 left-0 right-0 z-50' : 'bg-white shadow-sm border-b border-secondary-200' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2">
                <span class="text-2xl">📚</span>
                <span class="text-xl font-bold {{ $transparent ? 'text-white' : 'text-gradient' }}">PerpusKu</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                <a href="/" class="{{ $transparent ? 'text-white/90 hover:text-white' : 'text-secondary-600 hover:text-primary-600' }} font-medium transition">
                    Beranda
                </a>
                <a href="/books" class="{{ $transparent ? 'text-white/90 hover:text-white' : 'text-secondary-600 hover:text-primary-600' }} font-medium transition">
                    Katalog
                </a>
                @auth
                @if(auth()->user()->role === 'user')
                <a href="/loans" class="{{ $transparent ? 'text-white/90 hover:text-white' : 'text-secondary-600 hover:text-primary-600' }} font-medium transition">
                    Peminjaman Saya
                </a>
                @endif
                @endauth
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">
                <!-- Search Button -->
                <button class="p-2 rounded-lg {{ $transparent ? 'text-white/90 hover:bg-white/10' : 'text-secondary-600 hover:bg-secondary-100' }} transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <!-- User Menu (Desktop) -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                    {{-- User sudah login --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 p-2 rounded-lg {{ $transparent ? 'text-white hover:bg-white/10' : 'hover:bg-secondary-100' }} transition">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-sm font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="{{ $transparent ? 'text-white' : 'text-secondary-700' }} font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 {{ $transparent ? 'text-white/80' : 'text-secondary-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-secondary-200 py-2 z-50">
                            @if(auth()->user()->role === 'user')
                            <a href="/loans" class="flex items-center gap-2 px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Peminjaman Saya
                            </a>
                            @endif
                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil Saya
                            </a>
                            
                            @if(in_array(auth()->user()->role, ['petugas', 'admin']))
                            <hr class="my-2 border-secondary-200">
                            <a href="/petugas" class="flex items-center gap-2 px-4 py-2 text-sm text-primary-600 hover:bg-primary-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                </svg>
                                Dashboard Petugas
                            </a>
                            @endif
                            
                            @if(auth()->user()->role === 'admin')
                            <a href="/admin" class="flex items-center gap-2 px-4 py-2 text-sm text-primary-600 hover:bg-primary-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Dashboard Admin
                            </a>
                            @endif
                            
                            <hr class="my-2 border-secondary-200">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm text-error hover:bg-red-50 w-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    {{-- User belum login --}}
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium {{ $transparent ? 'text-white hover:text-white/80' : 'text-secondary-700 hover:text-primary-600' }} transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition">
                        Daftar
                    </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-nav-btn" class="md:hidden p-2 rounded-lg {{ $transparent ? 'text-white hover:bg-white/10' : 'text-secondary-600 hover:bg-secondary-100' }} transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-nav-menu" class="hidden md:hidden bg-white border-t border-secondary-200">
        <div class="px-4 py-3 space-y-2">
            <a href="/" class="block px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 font-medium">Beranda</a>
            <a href="/books" class="block px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 font-medium">Katalog</a>
            @auth
            @if(auth()->user()->role === 'user')
            <a href="/loans" class="block px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 font-medium">Peminjaman Saya</a>
            @endif
            <hr class="border-secondary-200">
            @if(in_array(auth()->user()->role, ['petugas', 'admin']))
            <a href="/petugas" class="block px-4 py-2 rounded-lg text-primary-600 hover:bg-primary-50 font-medium">Dashboard Petugas</a>
            @endif
            @if(auth()->user()->role === 'admin')
            <a href="/admin" class="block px-4 py-2 rounded-lg text-primary-600 hover:bg-primary-50 font-medium">Dashboard Admin</a>
            @endif
            <hr class="border-secondary-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 rounded-lg text-error hover:bg-red-50 font-medium">Keluar</button>
            </form>
            @else
            <hr class="border-secondary-200">
            <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 font-medium">Masuk</a>
            <a href="{{ route('register') }}" class="block px-4 py-2 rounded-lg text-primary-600 bg-primary-50 hover:bg-primary-100 font-medium">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-nav-btn')?.addEventListener('click', function() {
        document.getElementById('mobile-nav-menu')?.classList.toggle('hidden');
    });
</script>
