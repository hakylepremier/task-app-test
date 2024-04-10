<?php

use App\Models\Task;

use function Livewire\Volt\{state, mount, rules, on};

state([
    'tasks' => [],
    'name' => '',
    'deleteModal' => false,
    'editing' => null,
]);

$getTasks = fn() => ($this->tasks = Task::orderBy('priority')->latest()->get());

mount(function () {
    $this->tasks = $this->getTasks();
});

rules([
    'name' => 'required|string|max:255',
]);

$store = function () {
    $validated = $this->validate();

    $tasks = Task::create($validated);

    $this->name = '';

    $this->dispatch('task-created');

    $this->tasks = $this->getTasks();
};

$delete = function (Task $task) {
    // $this->authorize('delete', $task);

    $task->delete();

    $this->task = $this->getTasks();
};

$disableEditing = function () {
    $this->editing = null;

    return $this->getTasks();
};

$updateTaskPriority = function ($tasks) {
    // dd($tasks);
    foreach ($tasks as $task) {
        Task::find($task['value'])->update(['priority' => $task['order']]);
    }
    $this->tasks = $this->getTasks();
};

$edit = function (Task $task) {
    $this->editing = $task;

    $this->tasks = $this->getTasks();
};

on([
    'task-updated' => function () {
        // $this->goal = $this->goal->refresh();
        $this->editing = null;
        $this->tasks = $this->getTasks();
    },
    'task-edit-canceled' => $disableEditing,
]);
?>

<div data-theme="light" class="bg-transparent">
    <form wire:submit="store">
        <x-mary-input placeholder="Create a task" wire:model="name">
            <x-slot:append>
                {{-- Add `rounded-l-none` class --}}
                <x-mary-button label="Create Task" class="border-2 rounded-l-none btn-primary " type="submit"
                    spinner="save" />
            </x-slot:append>
        </x-mary-input>

        <x-slot:actions>
            <x-mary-button label="Cancel" />
        </x-slot:actions>
    </form>
    <ul wire:sortable="updateTaskPriority" class="py-4 space-y-2 text-gray-800">
        @foreach ($tasks as $task)
            <li wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                @if ($task->is($editing))
                    <livewire:tasks.edit :task="$task" :key="$task->id" />
                @else
                    <div class="flex items-center justify-between">
                        <p wire:sortable.handle>{{ $task->name }}</p>
                        <div class="flex items-center justify-center gap-2">
                            <x-mary-button label="Edit" wire:click="edit({{ $task->id }})"
                                spinner="edit({{ $task->id }})" class="btn-outline border-primary" />
                            <x-mary-button wire:click="delete({{ $task->id }})"
                                wire:confirm="Are you sure to delete this Task?" label="Delete"
                                spinner="delete({{ $task->id }})" class="btn-error" />
                        </div>
                        {{-- <x-mary-dropdown>
                            <x-mary-menu-item title="Archive" icon="o-archive-box" />
                            <x-mary-menu-item title="Remove" icon="o-trash" />
                            <x-mary-menu-item title="Restore" icon="o-arrow-path" />
                        </x-mary-dropdown> --}}
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
    </ul>
</div>
