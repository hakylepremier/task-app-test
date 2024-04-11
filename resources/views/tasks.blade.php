<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <livewire:tasks.project />
            <livewire:tasks.index />
        </div>
    </div>
</x-app-layout>
