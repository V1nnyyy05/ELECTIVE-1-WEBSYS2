<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="email" value="{{ __('Email') }}" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white placeholder-blue-200/50 focus:border-blue-400 focus:ring-blue-400" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="{{ __('Password') }}" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white focus:border-blue-400 focus:ring-blue-400" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-blue-300/30 text-blue-600 shadow-sm focus:ring-blue-500 bg-white/10" name="remember">
                <span class="ms-2 text-sm text-blue-100">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/20 transition-all duration-200">
                {{ __('Log in') }}
            </button>
            
            <div class="text-center">
                <a class="text-sm text-blue-200 hover:text-white underline transition-colors" href="{{ route('register') }}">
                
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>