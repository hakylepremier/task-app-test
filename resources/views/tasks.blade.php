<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Tasks') }}
    </h2>
  </x-slot>

  <div class="pb-12 pt-2">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <livewire:tasks.index />
    </div>
  </div>
</x-app-layout>
