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
    // dd($this->selectedProject);
    // $this->dispatch('project-selected', $this->selectedProject);
    // dump($this->selectedProject);
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
    {{-- <x-select label="Alternative" :options="$projects" option-value="id" option-label="title" placeholder="Select an user"
        placeholder-value="0" hint="Select one, please." wire:model="selectedProject"
        @change="$emit('project-selected', $selectedProject)" /> --}}
    {{-- <select id="category" wire:model="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>No category</option>
                @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @empty
                    <div></div>
                @endforelse
            </select> --}}
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
    {{-- @if ($selectedProject || $selectedProject == 0)
        <p>All task</p>
    @else
    @endif --}}
</div>
