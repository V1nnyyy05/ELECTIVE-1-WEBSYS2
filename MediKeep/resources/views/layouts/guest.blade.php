<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MediKeep') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .gradient-bg {
                background: radial-gradient(circle at top right, #1e40af, transparent),
                            radial-gradient(circle at bottom left, #1e3a8a, transparent),
                            #0f172a;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 gradient-bg">
            <div>
                <a href="/">
                    <h1 class="text-4xl font-black tracking-tighter text-white">
                        Medi<span class="text-blue-500">Keep</span>
                    </h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/10 backdrop-blur-lg shadow-2xl overflow-hidden sm:rounded-xl border border-white/20">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>