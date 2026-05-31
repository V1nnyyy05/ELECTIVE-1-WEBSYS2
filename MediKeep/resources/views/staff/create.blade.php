<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Staff/Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-600 p-8 rounded-3xl shadow-xl border border-white/10 backdrop-blur-md">
                <form method="POST" action="{{ route('staff.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="text-white font-bold">Staff Name</label>
                            <input type="text" name="name" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white rounded-lg" required>
                        </div>
                        <div>
                            <label class="text-white font-bold">Email Address</label>
                            <input type="email" name="email" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white rounded-lg" required>
                        </div>
                        <div>
                            <label class="text-white font-bold">Password</label>
                            <input type="password" name="password" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white rounded-lg" required>
                        </div>
                        <div>
                            <label class="text-white font-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="block mt-1 w-full bg-white/10 border-blue-300/30 text-white rounded-lg" required>
                        </div>

                        <button type="submit" class="w-full bg-white text-blue-600 font-black py-3 rounded-xl hover:bg-blue-50 transition">
                            Register Staff Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>