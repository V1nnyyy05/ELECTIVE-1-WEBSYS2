<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-center text-2xl font-bold text-white mb-6">Create Patient Account</h2>

        <div>
            <x-input-label for="name" value="{{ __('Full Name') }}" class="text-white" />
            <x-text-input id="name" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="{{ __('Email Address') }}" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="{{ __('Create Password') }}" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-white" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>
        <div class="mt-4">
            <label for="dob" class="block text-sm font-medium text-white mb-1">Birthday</label>
            <input type="date" name="dob" id="dob" required 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/10 text-white placeholder-gray-300"> 
        </div>

        <div class="mt-4 mb-4">
            <label for="gender" class="block text-sm font-medium text-white mb-1">Gender</label>
            <select name="gender" id="gender" required 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/10 text-white">
                <option value="" disabled selected class="text-gray-900">Select Gender</option>
                <option value="Male" class="text-gray-900">Male</option>
                <option value="Female" class="text-gray-900">Female</option>
            </select>
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg shadow-lg transition">
                {{ __('Register as Patient') }}
            </button>
            
            <div class="text-center">
                <a class="text-sm text-blue-200 hover:text-white underline" href="{{ route('login') }}">
                    {{ __('Already have an account? Log in') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>