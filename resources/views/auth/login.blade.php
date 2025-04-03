<x-guest-layout>
    <div class="flex justify-between border rounded-xl shadow-sm">
        <!-- Left Side - Dark Card Image -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#2467E9] items-center justify-center p-12 rounded-xl">
            <div class="text-white space-y-6">
                <div>
                    <h2 class="text-4xl font-bold">Telegram Bot Admin</h2>
                    <p class="text-lg text-gray-900">Manage your Telegram bot interactions efficiently and professionally.</p>
                </div>
                <div class="mt-8">
                    <img class="rounded-xl border" src="https://selzy.com/en/blog/wp-content/uploads/2024/02/telegram-bots.png" alt="Admin Dashboard" class="w-full max-w-md">
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="/" class="flex justify-center mb-4">
                        <img class="max-w-[80px]" src="https://propuskator.com/wp-content/uploads/2021/06/upravlenie-ustrojstvami-2smart-cloud-s-pomoshhyu-telegram-bota.png" alt="Logo">
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Welcome Back! 👋</h1>
                    <p class="mt-2 text-gray-600">Please login in to your account</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Enter your email"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center">
                            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-100 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                name="remember"
                                class="rounded border-gray-200 text-blue-600 shadow-sm focus:ring-blue-500"
                            >
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <!-- Social Login -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>