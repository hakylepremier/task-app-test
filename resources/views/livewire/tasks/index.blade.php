<?php

use App\Models\Task;
use App\Models\Project;

use function Livewire\Volt\{state, mount, rules, on};

$getProjects = fn() => ($this->projects = auth()->user()->projects()->latest()->get());

state([
    'tasks' => [],
    'name' => '',
    'project_id' => '',
    'projects' => [],
    'deleteModal' => false,
    'editing' => null,
    'message' => 'All tasks',
]);

// gets all task for authorised user
$getTasks = fn() => ($this->tasks = auth()->user()->tasks()->with('project')->orderBy('priority')->latest()->get());

mount(function () {
    $this->tasks = $this->getTasks();
    $this->projects = $this->getProjects();
});

rules([
    'name' => 'required|string|max:255',
    'project_id' => 'integer',
]);

$store = function () {
    $validated = $this->validate();
    // checks if project id is '', which is default and makes it null before storing
    if ($this->project_id == '') {
        $project = ['project_id' => null];
        // $task = array_diff($first, $second);
        $task = array_merge($validated, $project);
    } else {
        $task = $validated;
    }
    // dd($task);
    auth()->user()->tasks()->create($task);

    // $tasks = Task::create($validated);

    $this->name = '';
    $this->project_id = null;

    // $this->dispatch('task-created');

    $this->tasks = $this->getTasks();
    $this->message = 'All tasks';
};

$delete = function (Task $task) {
    // $this->authorize('delete', $task);

    $task->delete();

    $this->task = $this->getTasks();
    $this->message = 'All tasks';
};

$disableEditing = function () {
    $this->editing = null;

    return $this->getTasks();
};

// this changes the priority of the task when a drag and drop occurs.
// livewire-sortable package uses
$updateTaskPriority = function ($tasks) {
    // dd($tasks);
    foreach ($tasks as $task) {
        Task::find($task['value'])->update(['priority' => $task['order']]);
    }
    $this->message = 'All tasks';
    $this->tasks = $this->getTasks();
};

$edit = function (Task $task) {
    $this->editing = $task;
    $this->message = 'All tasks';

    $this->tasks = $this->getTasks();
};

$cancel = function () {
    $this->name = '';
    $this->project_id = '';

    // $this->tasks = $this->getTasks();
};

on([
    'task-updated' => function () {
        // $this->goal = $this->goal->refresh();
        $this->editing = null;
        $this->tasks = $this->getTasks();
    },
    'project-selected' => function (Project $project) {
        if ($project) {
            $this->tasks = auth()
                ->user()
                ->tasks()
                ->where(['project_id' => $project->id])
                ->orderBy('priority')
                ->latest()
                ->get();
            $this->message = 'Tasks for project: ' . $project->title;
        } else {
            $this->message = 'Selected projects has no tasks';
        }
    },
    'project-all-selected' => $disableEditing,
    'project-none-selected' => function () {
        $this->tasks = auth()
            ->user()
            ->tasks()
            ->where(['project_id' => null])
            ->orderBy('priority')
            ->latest()
            ->get();
        $this->message = 'Tasks without a Project';
    },
    'project-selected-not-found' => function () {
        $this->tasks = [];
        $this->message = 'Selected projects has no tasks';
    },
    'task-edit-canceled' => $disableEditing,
]);
?>

<div data-theme="light" class="bg-transparent md:flex gap-4">
  <aside class="lg:basis-1/4 basis-[12rem]">
    <form wire:submit="store" class="flex flex-col gap-2 border-gray-300 border-b-2 py-2">
      <h2 class="font-bold text-lg">Create Task</h2>
      <x-mary-input placeholder="Add a name" wire:model="name" />

      <select class="w-full select select-bordered" wire:model="project_id">
        <option value="" selected>No project selected</option>
        @forelse ($projects as $project)
          <option value="{{ $project->id }}">{{ $project->title }}</option>
        @empty
          <div></div>
        @endforelse
      </select>

      <div class="flex justify-end gap-2">
        <x-mary-button label="Create Task" class="btn-primary " type="submit" spinner="save" />
        <x-mary-button label="Cancel" wire:click="cancel" />
      </div>
    </form>
    <div class="py-4">
      <livewire:tasks.project />
    </div>
  </aside>
  <section class="lg:basis-3/4 flex-1 ">
    <h2 class="font-bold md:text-lg text-center pt-2">{{ $message }}</h2>
    <ul wire:sortable="updateTaskPriority" class="py-2 space-y-2 text-gray-800">
      @forelse ($tasks as $task)
        <li wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}"
          class="px-4 py-2 bg-gray-200 rounded-lg">
          @if ($task->is($editing))
            <livewire:tasks.edit :task="$task" :key="$task->id" />
          @else
            <div class="flex items-center justify-between">
              <div wire:sortable.handle class="cursor-move">
                <h3>{{ $task->name }}</h3>
                @if ($task->project)
                  <p class="text-xs text-gray-400">Project: {{ $task->project->title }}</p>
                @endif
              </div>
              <div class="flex items-center justify-center gap-2">
                <x-mary-button label="Edit" wire:click="edit({{ $task->id }})" spinner="edit({{ $task->id }})"
                  class="btn-outline border-primary btn-sm" />
                <x-mary-button wire:click="delete({{ $task->id }})" wire:confirm="Are you sure to delete this Task?"
                  label="Delete" spinner="delete({{ $task->id }})" class="btn-error btn-sm" />
              </div>
              {{-- <x-mary-dropdown>
                              <x-mary-menu-item title="Archive" icon="o-archive-box" />
                              <x-mary-menu-item title="Remove" icon="o-trash" />
                              <x-mary-menu-item title="Restore" icon="o-arrow-path" />
                          </x-mary-dropdown> --}}
            </div>
          @endif
        </li>
      @empty
        <p>No tasks available</p>
      @endforelse
    </ul>
  </section>

</div>
