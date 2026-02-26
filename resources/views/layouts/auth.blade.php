<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PerpusKu')</title>
    
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📚</text></svg>">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary-50 via-white to-primary-100 min-h-screen">
    <div class="flex min-h-screen">
        {{-- Left Side - Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 to-primary-800 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -top-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <div class="flex items-center gap-3 mb-8">
                    <span class="text-5xl">📚</span>
                    <h1 class="text-4xl font-bold">PerpusKu</h1>
                </div>
                <h2 class="text-3xl font-semibold mb-4">Perpustakaan Digital Modern</h2>
                <p class="text-primary-100 text-lg leading-relaxed mb-8">
                    Akses ribuan buku dengan mudah. Pinjam, baca, dan kelola koleksi bacaan Anda dari mana saja.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">5000+ Buku</h3>
                            <p class="text-sm text-primary-200">Koleksi lengkap berbagai genre</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">24/7 Akses</h3>
                            <p class="text-sm text-primary-200">Pinjam kapan saja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side - Form --}}
        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center justify-center gap-2 mb-8">
                    <span class="text-4xl">📚</span>
                    <h1 class="text-2xl font-bold text-primary-700">PerpusKu</h1>
                </div>

                {{-- Flash Messages --}}
                @if(session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
