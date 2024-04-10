<?php

use App\Models\Task;

use function Livewire\Volt\{mount, rules, state};

state(['task', 'name']);

rules(['name' => 'required|string|max:255']);

mount(function (Task $task) {
    $this->task = $task;
    $this->name = $task->name;
});

$update = function () {
    // $this->authorize('update', $this->task);

    $validated = $this->validate();

    $this->task->update($validated);

    $this->dispatch('task-updated');
};

$cancel = fn() => $this->dispatch('task-edit-canceled');

?>

<div>
    <div>
        <form wire:submit="update" class="flex justify-between">
            <x-mary-input placeholder="Edit your task" wire:model="name" />
            <div class="flex items-center justify-center gap-2">
                <x-mary-button label="Save" type="submit" spinner="update" />
                <x-mary-button wire:click.prevent="cancel" label="Cancel" spinner="cancel" />
            </div>
        </form>
        {{-- <x-mary-dropdown>
                            <x-mary-menu-item title="Archive" icon="o-archive-box" />
                            <x-mary-menu-item title="Remove" icon="o-trash" />
                            <x-mary-menu-item title="Restore" icon="o-arrow-path" />
                        </x-mary-dropdown> --}}
    </div>
</div>
