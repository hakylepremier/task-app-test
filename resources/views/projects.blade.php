<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Projects') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
      <livewire:projects.index />
    </div>
  </div>
</x-app-layout>
