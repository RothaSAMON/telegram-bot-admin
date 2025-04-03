<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Telegram Bot Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <livewire:telegram-users-list />
                </div>
                <div class="md:col-span-2">
                    <livewire:telegram-chat />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>