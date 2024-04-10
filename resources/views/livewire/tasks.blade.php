<?php

use App\Models\Task;

use function Livewire\Volt\{state, mount, rules};

state([
    'tasks' => [],
    'name' => '',
    'deleteModal' => false,
]);

$getTasks = fn() => ($this->tasks = Task::orderBy('priority')->get());

mount(function () {
    $this->task = $this->getTasks();
});

rules([
    'name' => 'required|string|max:255',
]);

$store = function () {
    $validated = $this->validate();

    $task = Task::create($validated);

    $this->name = '';

    $this->dispatch('task-created');

    $this->task = $this->getTasks();
};

$delete = function (Task $task) {
    // $this->authorize('delete', $task);

    $task->delete();

    $this->task = $this->getTasks();
};

?>

<div>
    <form wire:submit="store">
        <x-mary-input label="Create a task" wire:model="name">
            <x-slot:append>
                {{-- Add `rounded-l-none` class --}}
                <x-mary-button label="Create Task" class="rounded-l-none btn-primary" type="submit" spinner="save" />
            </x-slot:append>
        </x-mary-input>

        <x-slot:actions>
            <x-mary-button label="Cancel" />
        </x-slot:actions>
    </form>
    @foreach ($tasks as $task)
        <div class="flex justify-between">
            <p>{{ $task->name }}</p>
            <div>
                <x-mary-button label="Edit" />
                <x-mary-button wire:click="delete({{ $task->id }})"
                    wire:confirm="Are you sure to delete this chirp?" label="Delete"
                    spinner="delete({{ $task->id }})" />
            </div>
        </div>
    @endforeach
</div>
