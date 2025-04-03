<x-guest-layout>
    <div class="flex justify-between border rounded-xl shadow-sm">
        <!-- Left Side - Dark Card Image -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#2467E9] items-center justify-center p-12 rounded-xl">
            <div class="text-white space-y-6">
                <div>
                    <h2 class="text-4xl font-bold">Telegram Bot Admin</h2>
                    <p class="text-lg text-gray-900">Create your account to manage Telegram bot interactions.</p>
                </div>
                <div class="mt-8">
                    <img class="rounded-xl border" src="https://selzy.com/en/blog/wp-content/uploads/2024/02/telegram-bots.png" alt="Admin Dashboard" class="w-full max-w-md">
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="/" class="flex justify-center mb-4">
                        <img class="max-w-[80px]" src="https://propuskator.com/wp-content/uploads/2021/06/upravlenie-ustrojstvami-2smart-cloud-s-pomoshhyu-telegram-bota.png" alt="Logo">
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Create Account 🚀</h1>
                    <p class="mt-2 text-gray-600">Register to get started</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700" />
                        <x-text-input 
                            id="name" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autocomplete="username"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your email"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                        <x-text-input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Create a password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700" />
                        <x-text-input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Confirm your password"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="flex items-center justify-center mt-4">
                        <span class="text-sm text-gray-600">Already have an account?</span>
                        <a class="ml-2 text-sm text-blue-600 hover:text-blue-800 font-medium" href="{{ route('login') }}">
                            {{ __('Sign in') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>