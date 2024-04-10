<?php

namespace Tests\Feature\Livewire\Tasks;

use Livewire\Volt\Volt;
use Tests\TestCase;

class EditTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $component = Volt::test('tasks.edit');

        $component->assertSee('');
    }
}
