<?php

use App\Models\Project;

use function Livewire\Volt\{state, mount, on};

$getProjects = fn() => ($this->projects = auth()->user()->projects()->latest()->get());

$filter = function () {
    // dump($this->project_id);
    if ($this->project_id == 'all') {
        $this->selectedProject = null;
        $this->dispatch('project-all-selected');
    } elseif ($this->project_id == 'none') {
        $this->selectedProject = null;
        $this->dispatch('project-none-selected');
    } else {
        $this->selectedProject = Project::find($this->project_id);
        $this->selectedProject ? $this->dispatch('project-selected', $this->selectedProject) : $this->dispatch('project-selected-not-found');
    }
};

state([
    'projects' => [],
    'project_id' => 'all',
    'selectedProject' => null,
]);

mount(function () {
    $this->projects = $this->getProjects();
});

on([
    'project-selected' => function (Project $project) {
        $this->selectedProject = $project;
    },
]);

?>

<div data-theme="light" class="pb-4 bg-transparent">
  <form wire:submit='filter' class="flex">

    <select class="w-full select select-bordered" wire:model="project_id">
      <option value="all" selected>All tasks</option>
      <option value="none" selected>Tasks with No Project</option>
      @forelse ($projects as $project)
        <option value="{{ $project->id }}">{{ $project->title }}</option>
      @empty
        <div></div>
      @endforelse
    </select>
    <x-mary-button label="Filter" spinner="filter" class="btn-accent" type="submit" />

  </form>
</div>
