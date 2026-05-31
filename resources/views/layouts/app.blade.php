<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TunisTour IA - Échappée Tunisienne Virtuelle')</title>
    <!-- Tailwind CSS dynamic CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slate: {
                            850: '#141e30',
                            950: '#070a13'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 min-h-screen flex flex-col font-sans antialiased">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-slate-900 border-b border-slate-800 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="bg-red-600 p-2 rounded-xl flex items-center justify-center shadow-lg shadow-red-900/40">
                        <i class="fa-solid fa-compass text-white text-md animate-spin-slow"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 leading-none">
                            <span class="font-sans font-black text-base tracking-tight bg-gradient-to-r from-white via-slate-200 to-red-400 bg-clip-text text-transparent">
                                TunisTour IA
                            </span>
                            <span class="bg-red-500/15 text-red-400 text-[9px] font-sans font-bold px-2 py-0.5 rounded-full border border-red-500/20">
                                Tunisie
                            </span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-sans mt-0.5 font-medium">
                            Carthage, Sidi Bou Saïd, Djerba & Tourisme Tunisien
                        </p>
                    </div>
                </a>

                <!-- Navigation links and Active Profile Connected Badge -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('chatbot.index') }}" class="inline-flex items-center gap-1.5 text-xs text-amber-300 hover:text-white bg-amber-500/10 hover:bg-amber-500/20 px-3 py-1.5 rounded-xl border border-amber-500/20 transition-all font-semibold">
                        <i class="fa-solid fa-robot"></i>
                        <span>Discuter avec TunisBot</span>
                    </a>

                    <!-- Profile / Connexion State (Simulé en PHP basé sur l'utilisateur connecté) -->
                    <div class="flex items-center gap-3 border-l border-slate-800 pl-4">
                        <div class="hidden md:flex flex-col text-right">
                            <span class="text-xs font-bold text-slate-100 flex items-center gap-1.5 justify-end">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                Iteb Kharroubi
                            </span>
                        </div>
                        <!-- Profile Avatar -->
                        <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-xs text-white" title="Iteb Kharroubi">
                            👤
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Success / Error General Alert messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-fade-in">
            <div class="bg-green-100 border border-green-200 text-green-800 text-xs px-4 py-3.5 rounded-xl flex items-center gap-2.5 shadow-sm">
                <i class="fa-solid fa-circle-check text-green-600 text-sm"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 py-8 text-center text-xs">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; 2026 TunisTour IA. Exploration et circuits d'excellence en Tunisie.</p>
            <p class="mt-1 text-slate-500">Conçu pour s'exécuter en PHP pur sans dépendances superflues.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
