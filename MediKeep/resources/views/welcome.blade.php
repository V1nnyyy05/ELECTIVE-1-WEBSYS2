<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediKeep | Smart Clinic Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: radial-gradient(circle at top right, #1e40af, transparent),
                        radial-gradient(circle at bottom left, #1e3a8a, transparent),
                        #0f172a;
        }
        .floating { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen text-white overflow-x-hidden font-sans">

    <nav class="flex justify-between items-center p-8 max-w-7xl mx-auto">
        <div class="text-2xl font-black tracking-tighter">
            Medi<span class="text-blue-500">Keep</span>
        </div>
        <div class="space-x-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full font-bold transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-400 transition font-medium">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-white text-black px-6 py-2 rounded-full font-bold hover:bg-blue-100 transition">Get Started</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 pt-20 pb-32 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-7xl font-black leading-tight mb-6">
                Streamline Your <br>
                <span class="text-blue-500">Appointments.</span>
            </h1>
            <p class="text-blue-100/70 text-xl mb-10 leading-relaxed max-w-md">
                A digital hub for healthcare providers to manage patient enrollment, secure records, and automate daily schedules with precision.
            </p>
            
            <div class="flex space-x-4">
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-xl font-bold text-lg shadow-lg shadow-blue-500/40 transition">
                    Register Now
                </a>
                <a href="{{ route('login') }}" class="border border-blue-500/50 hover:bg-blue-900/50 px-8 py-4 rounded-xl font-bold text-lg transition text-blue-400">
                    Login
                </a>
            </div>
        </div>

        <div class="relative flex justify-center items-center">
            <div class="floating relative z-10 p-12 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-center mt-4 text-blue-300 font-medium">Manage Schedules</p>
            </div>
            
            <div class="absolute -bottom-10 -right-10 floating" style="animation-delay: 2s;">
                <div class="p-6 bg-blue-600/20 rounded-2xl border border-blue-500/20 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-12 text-center text-blue-300/50 text-sm">
        <p>&copy; 2026 MediKeep Management System. All rights reserved.</p>
    </footer>

</body>
</html>