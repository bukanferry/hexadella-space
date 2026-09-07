<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-size: 13.5px;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Hexadella Space' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px) scale(1); }
            33% { transform: translateY(-30px) translateX(20px) scale(1.05); }
            66% { transform: translateY(20px) translateX(-20px) scale(0.95); }
        }
        .animate-float {
            animation: float 12s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 15s ease-in-out infinite;
            animation-delay: -7s;
        }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }
    </style>
</head>
<body class="antialiased bg-gray-950 text-gray-100 flex flex-col min-h-screen relative overflow-x-hidden selection:bg-purple-500/30">
    
    <!-- Dynamic Animated Grid Background -->
    <div class="fixed inset-0 z-[-20] bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>

    <!-- Animated Ambient Orbs -->
    <div class="fixed top-[-10%] left-[-10%] w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-[120px] animate-float pointer-events-none -z-10"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[150px] animate-float-delayed pointer-events-none -z-10"></div>

    <!-- Navbar (Minimalist - only for inner pages) -->
    @if(!request()->is('/'))
    <nav class="border-b border-gray-800 bg-gray-950/50 backdrop-blur sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2.5 group">
                <img src="{{ asset('img/logo.png') }}" class="h-8 w-auto object-contain transition-transform group-hover:scale-105" alt="Logo">
                <span class="text-xl font-bold tracking-tight text-gray-100">hexadella<span class="text-purple-500">.space</span></span>
            </a>
            <div class="text-sm text-gray-400 flex items-center space-x-4">
                <span class="hidden md:inline">Zero Logs. Zero Footprint.</span>
            </div>
        </div>
    </nav>
    @endif

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-6xl">
        {{ $slot }}
    </main>

    <!-- Footer Disclaimer -->
    <footer class="mt-auto py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="mb-6">
                <a href="{{ route('about') }}" class="text-xs text-purple-400/80 hover:text-purple-400 font-medium tracking-wider uppercase transition-colors inline-flex items-center gap-1.5 border border-purple-500/20 bg-purple-500/5 px-4 py-2 rounded-full hover:bg-purple-500/10 hover:border-purple-500/30 shadow-[0_0_15px_rgba(168,85,247,0.05)] hover:shadow-[0_0_20px_rgba(168,85,247,0.15)]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Baca Manifesto Kami
                </a>
            </div>
            <p class="text-gray-500 text-xs leading-relaxed max-w-4xl mx-auto">
                <strong class="font-semibold text-gray-300">Hexadella Space</strong> adalah platform interaksi santai berbasis privasi penuh. Konten yang melanggar hukum, mengandung ancaman kekerasan, penipuan, atau materi terlarang akan dimusnahkan secara otomatis oleh sistem. Seluruh data bersifat fana dan tidak disimpan secara permanen.
            </p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
