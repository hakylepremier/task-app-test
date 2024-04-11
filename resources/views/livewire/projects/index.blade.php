<?php

use App\Models\Project;

use function Livewire\Volt\{state, mount, rules, on};

state([
    'projects' => [],
    'project' => null,
    'title' => '',
    'edit_title' => '',
    'deleteModal' => false,
    'editing' => null,
]);

$getProjects = fn() => ($this->projects = auth()->user()->projects()->latest()->get());

mount(function () {
    $this->projects = $this->getProjects();
});

rules([
    'title' => 'required|string|max:255',
    // 'edit_title' => 'required|string|max:255',
]);

$store = function () {
    $validated = $this->validate();

    auth()->user()->projects()->create($validated);

    // Project::create($validated);

    $this->title = '';

    // $this->dispatch('project-created');

    $this->projects = $this->getProjects();
};

$update = function () {
    $validated = $this->validate();
    // dd($validated);

    $this->editing->update($validated);
    $this->title = '';
    $this->editing = null;
    $this->projects = $this->getProjects();

    // $this->dispatch('task-updated');
};

$cancel = function () {
    $this->editing = null;
    $this->projects = $this->getProjects();
};

$edit = function (Project $project) {
    $this->editing = $project;
    $this->title = $project->title;
    $this->message = 'All projects';
    // $this->projects = $this->getProjects();
};

$delete = function (Project $project) {
    $project->delete();

    $this->editing = null;
    $this->projects = $this->getProjects();
};

?>

<div data-theme="light" class="bg-transparent">
  @if (!$editing)
    <form wire:submit="store" class="flex justify-between">
      <div>
        <x-mary-input placeholder="Create a Project" wire:model="title" class="flex-1" />
      </div>
      <x-mary-button label="Save" type="submit" spinner="store" class="btn-primary" />
    </form>
  @else
    <form wire:submit="update" class="flex items-center justify-between gap-2">
      <x-mary-input placeholder="Edit your Project" wire:model="title" class="flex-1 flex-grow" />
      <p>Edit: {{ $editing->title }}</p>
      <div class="flex items-center justify-center gap-2">
        <x-mary-button label="Save" type="submit" spinner="update" class="btn-sm btn-primary" />
        <x-mary-button wire:click.prevent="cancel" label="Cancel" spinner="cancel" class="btn-sm btn-accent" />
      </div>
    </form>
  @endif
  <ul class="py-4 space-y-2 text-gray-800">
    @forelse ($projects as $project)
      <li wire:key="project-{{ $project->id }}" class="px-4 py-2 bg-gray-200 rounded-lg">

        <div class="flex items-center justify-between">
          <h3>{{ $project->title }}</h3>
          <div class="flex items-center justify-center gap-2">
            <x-mary-button wire:click="edit({{ $project->id }})" label="Edit" spinner="edit({{ $project->id }})"
              class="btn-outline border-primary btn-sm" />
            <x-mary-button wire:click="delete({{ $project->id }})" wire:confirm="Are you sure to delete this Project?"
              label="Delete" spinner="delete({{ $project->id }})" class="btn-error btn-sm" />
          </div>
        </div>

      </li>
    @empty
      <p class="text-center">No projects available</p>
    @endforelse
  </ul>
</div>
